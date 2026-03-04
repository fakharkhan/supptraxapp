# Product Requirements Document (PRD): SupptraxApp Admin Panel

**Version:** 1.1  
**Date:** March 4, 2026  
**Source:** Generated from analysis of `supptrax-data` project  
**Scope:** Admin Panel only (Client Panel to be developed later)

---

## 1. Executive Summary

**SupptraxApp Admin Panel** is an internal Laravel + Filament admin application for staff to ingest, manage, and analyze data extracted from **Supptrax** (supptrax.com)—a roofing/insurance supplement claims management platform. The data is scraped by the `supptrax-data` Node.js project and stored as CSV files. The Admin Panel provides a centralized back-office interface to import CSVs, view, search, filter, and export this claims and comments data.

**Out of scope for this PRD:** Client-facing panel, public portals, or end-user dashboards. Those will be addressed in a future PRD.

---

## 2. Admin Panel Overview

### 2.1 Purpose
- **Internal use only** – Staff (admins, closers, claim handlers) manage scraped Supptrax data
- **Single panel** – One Filament admin panel at `/admin` (existing setup)
- **No public routes** – All functionality behind authentication

### 2.2 Admin Panel Structure

| Section | Description |
|--------|-------------|
| **Dashboard** | Overview widgets: total comments, total claims, comments by board, claims by status |
| **Claim Comments** | List, search, filter, view, export scraped comments |
| **Claims** | List, search, filter claims from claims_board.csv |
| **Import** | CSV import actions (claim comments, claims, reference data) |
| **Reference Data** | Statuses, Adjusters, Insurance Companies, Locations (list + optional CRUD) |

### 2.3 Navigation (Sidebar)
- Dashboard (default landing)
- Claim Comments
- Claims
- Import (or nested under Settings)
- Statuses
- Adjusters
- Insurance Companies
- Locations

---

## 3. Source Data Overview (supptrax-data)

### 3.1 Data Sources

| Source | Description | Format |
|--------|-------------|--------|
| **supptrax.com** | External SaaS platform for roofing supplement claims | Scraped via Playwright |
| **CSV exports** | Manually exported or scraped data | Stored in `Orignal/Client/Data/` |

### 3.2 Scraped Data (Claim Comments)

- **Boards:** 15, 18, 19, 54, 59, 60 (each board = a paginated list of claims)
- **Scrape behavior:** For each page, opens the first claim's "View all comments" panel and extracts comments
- **Output:** One CSV per board: `supptrax_claim_comments_board_{id}.csv`
- **Legacy:** `supptrax_claim_comments.csv` (Board 19, page 1 only; different schema)

### 3.3 Reference Data (CSV Files)

| File | Purpose |
|------|---------|
| `claims_board.csv` | Master claims list with location, claimant, dates, status, insurance, adjuster |
| `adjusters.csv` | Adjuster directory (name, company, email, phone) |
| `insurance_companies.csv` | Insurance companies (name, location, phone, email, adjuster count) |
| `locations.csv` | Roofing locations/organizations (name, total_claims, show_board) |
| `statuses_manage.csv` | Claim status definitions (name, abbreviation, color, description) |
| `statuses_details.csv` | Status counts (status_name, total) |
| `client_organization_details.csv` | Organization billing/contact info |
| `client_organization_users.csv` | Users (name, email, type, chaser, closer, claims) |
| `subscription_plans.csv` | Plan types and pricing |
| `support_topics.csv` | Support topic categories |

---

## 4. Data Models

### 4.1 Claim Comments (Primary Scraped Data)

**Schema (per-row):**

| Field | Type | Notes |
|-------|------|-------|
| `page` | integer | Board pagination (1–24 for board 54, etc.) |
| `index` | integer | Comment order within the page/claim |
| `author` | string | Commenter name (often "Unknown" due to extraction limits) |
| `text` | text | Comment body (may be truncated) |
| `timestamp` | string | e.g. "Mar 02, 2026 15:53" or "Feb 28, 2026 • 20:15" |

**Notes:**
- Timestamps may span multiple lines in CSV (newline inside quoted field)
- Author can be "All Comments" (header artifact) or "Unknown"
- Text may contain commas, quotes, newlines → proper CSV escaping required

### 4.2 Claims Board

**Schema (claims_board.csv):**

| Field | Type | Notes |
|-------|------|-------|
| `location` | string | e.g. "Able Roofing", "Mr. Roof" |
| `claimant` | string | Policyholder/claimant name |
| `claim_date` | date | Format: "Oct 03, 2025" |
| `submission_date` | date | "-" if empty |
| `funding_date` | date | "-" if empty |
| `status` | string | Abbreviation (SS, CBC, ESTI, NONE, etc.) |
| `insurance` | string | Insurance company name |
| `adjuster_name` | string | Assigned adjuster |
| `adjuster_phone` | string | Phone number |
| `claim_handler` | string | Internal handler (e.g. "Elizabeta Gruevski") |
| `client` | string | Closer/owner (e.g. "David Hughes", "Sarah McGarvey") |

### 4.3 Status (statuses_manage.csv)

| Field | Type |
|-------|------|
| `status_name` | string |
| `abbreviation` | string (e.g. SR, WSC, SS) |
| `color` | string (e.g. Gray, Purple, Blue) |
| `description` | string |

### 4.4 Adjusters

| Field | Type |
|-------|------|
| `adjuster_name` | string |
| `company_name` | string |
| `email` | string |
| `phone_number` | string |

### 4.5 Insurance Companies

| Field | Type |
|-------|------|
| `company_name` | string |
| `location` | string |
| `phone_number` | string |
| `email` | string |
| `adjusters` | integer |

### 4.6 Locations

| Field | Type |
|-------|------|
| `location_name` | string |
| `total_claims` | integer |
| `show_board` | boolean (true/false) |

---

## 5. Admin Panel Functional Requirements

### 5.1 Data Import (Admin Actions)

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-1 | **CSV Import – Claim Comments** – Import claim comment CSVs (board 15, 18, 19, 54, 59, 60) with validation and error handling | P0 |
| FR-2 | **CSV Import – Claims Board** – Import `claims_board.csv` and map to claims/statuses | P0 |
| FR-3 | **CSV Import – Reference Data** – Import adjusters, insurance companies, locations, statuses | P1 |
| FR-4 | **Import Source Tracking** – Store `board_id` and `source_file` for each comment record | P1 |
| FR-5 | **Idempotent / Incremental Import** – Support re-import without duplicates (e.g. by board+page+index or hash) | P1 |
| FR-6 | **Timestamp Parsing** – Normalize timestamps (e.g. "Mar 02, 2026 15:53", "Feb 28, 2026 • 20:15") to `datetime` | P0 |

### 5.2 Claim Comments (Admin Resource)

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-7 | **List Comments** – Paginated table with columns: board, page, index, author, text (truncated), timestamp | P0 |
| FR-8 | **Search Comments** – Full-text search on `author` and `text` | P0 |
| FR-9 | **Filter by Board** – Filter by board ID (15, 18, 19, 54, 59, 60) | P0 |
| FR-10 | **Filter by Author** – Filter by comment author | P1 |
| FR-11 | **Filter by Date Range** – Filter by parsed timestamp | P1 |
| FR-12 | **View Comment Detail** – Full comment text in view/edit modal | P0 |
| FR-13 | **Export** – Export filtered comments to CSV | P1 |

### 5.3 Claims (Admin Resource)

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-14 | **List Claims** – Paginated table with all claim fields | P0 |
| FR-15 | **Filter by Status** – Filter by status abbreviation | P0 |
| FR-16 | **Filter by Location** – Filter by location (Able Roofing, Mr. Roof, etc.) | P0 |
| FR-17 | **Filter by Insurance** – Filter by insurance company | P1 |
| FR-18 | **Filter by Client** – Filter by claim handler/closer | P1 |
| FR-19 | **Search** – Search claimant, adjuster, etc. | P1 |

### 5.4 Reference Data (Admin Resources)

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-20 | **CRUD – Statuses** – Manage status definitions (abbreviation, color, description) | P2 |
| FR-21 | **CRUD – Adjusters** – Manage adjuster directory | P2 |
| FR-22 | **CRUD – Insurance Companies** – Manage insurance companies | P2 |
| FR-23 | **CRUD – Locations** – Manage locations | P2 |

### 5.5 Admin Dashboard

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-24 | **Dashboard** – Total comments, total claims, comments by board | P1 |
| FR-25 | **Comments by Board** – Chart or widget showing comment count per board | P1 |
| FR-26 | **Claims by Status** – Distribution of claims by status | P1 |
| FR-27 | **Recent Activity** – Latest comments/imports | P2 |

### 5.6 Admin Authentication & Access

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-28 | **Admin Authentication** – Filament login (already implemented) | Done |
| FR-29 | **Role-based Access** – Optional: restrict import to admins | P2 |

---

## 6. Non-Functional Requirements

| ID | Requirement |
|----|-------------|
| NFR-1 | **Performance** – Import of 500+ comments per board should complete in < 30 seconds |
| NFR-2 | **Data Integrity** – Preserve CSV escaping (commas, quotes, newlines) on import |
| NFR-3 | **Auditability** – Log import runs (file, timestamp, row count, errors) |
| NFR-4 | **Responsive** – Admin UI usable on desktop (1024px+); mobile optional |

---

## 7. Technical Constraints

| Constraint | Notes |
|------------|-------|
| **Framework** | Laravel 12 + Filament 5 (already installed) |
| **Database** | SQLite or MySQL/PostgreSQL (configurable) |
| **Import Path** | Configurable path to CSV directory (e.g. `supptrax-data/Orignal/Client/Data/`) |
| **File Encoding** | UTF-8 assumed |

---

## 8. Data Quality Issues (from supptrax-data)

| Issue | Impact | Mitigation |
|-------|--------|------------|
| **Author = "Unknown"** | Many comments lack author due to accessibility tree limits | Display as-is; allow manual override in future |
| **Author = "All Comments"** | Header artifact from extraction | Filter or normalize on import |
| **Text truncation** | Some comments truncated with "..." | Store as-is; flag for manual review if needed |
| **Timestamp formats** | "Mar 02, 2026 15:53" vs "Feb 28, 2026 • 20:15" | Parse both; store as nullable datetime |
| **Multiline CSV fields** | Timestamps/text can span lines | Use robust CSV parser (e.g. `league/csv`) |
| **Missing claim linkage** | Comments have board+page+index but no direct claim ID | Link via board+page if claims_board can be aligned |

---

## 9. Admin Panel Implementation Phases

### Phase 1: Admin Panel Foundation (MVP)
- Database migrations for: `boards`, `claim_comments`, `claims`, `statuses`, `adjusters`, `insurance_companies`, `locations`
- Admin CSV import action for claim comments (all 6 boards)
- Filament Resource: Claim Comments (list, view, search, filter by board)
- Admin Dashboard with basic count widgets

### Phase 2: Admin Claims & Reference Data
- Admin import for claims_board, statuses, adjusters, insurance_companies, locations
- Filament Resource: Claims (list, filters)
- Admin Dashboard: comments by board, claims by status

### Phase 3: Admin Enhanced Features
- Export to CSV (admin table action)
- Date range and author filters
- Import history/audit log (admin-only view)

### Phase 4: Admin Optional
- CRUD for reference data (Statuses, Adjusters, Insurance Companies, Locations)
- Admin roles (e.g. restrict import to super-admin)
- Manual comment editing in admin

---

## 10. File Reference (supptrax-data)

### Scraper Scripts
- `scripts/scrape-board-15-comments.js` – Board 15 (auto-detect pages, max 20)
- `scripts/scrape-board-18-comments.js` – Board 18 (9 pages)
- `scripts/scrape-board-19-comments.js` – Board 19 (13 pages)
- `scripts/scrape-board-54-comments.js` – Board 54 (24 pages)
- `scripts/scrape-board-59-comments.js` – Board 59 (auto-detect, max 20)
- `scripts/scrape-board-60-comments.js` – Board 60 (auto-detect, max 20)
- `scripts/extract-comments.js` – Shared extraction logic

### Output Path
- `Orignal/Client/Data/` – All CSV files

### Documentation
- `docs/supptrax-comments-scrape-notes.md` – Scrape workflow and limitations

---

## 11. Appendix: Board Configuration

| Board ID | Pages | URL |
|----------|-------|-----|
| 15 | Auto (max 20) | https://supptrax.com/board/15 |
| 18 | 9 | https://supptrax.com/board/18 |
| 19 | 13 | https://supptrax.com/board/19 |
| 54 | 24 | https://supptrax.com/board/54 |
| 59 | Auto (max 20) | https://supptrax.com/board/59 |
| 60 | Auto (max 20) | https://supptrax.com/board/60 |

---

## 12. Approval & Revision History

| Version | Date | Author | Changes |
|---------|------|--------|---------|
| 1.0 | 2026-03-04 | — | Initial PRD from supptrax-data scan |
| 1.1 | 2026-03-04 | — | Scoped to Admin Panel only; added Admin Panel structure; Client Panel deferred |
