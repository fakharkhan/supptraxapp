# UI/UX Document: SupptraxApp Admin Panel

**Version:** 1.0  
**Date:** March 4, 2026  
**Related:** [PRD-supptraxapp.md](./PRD-supptraxapp.md)  
**Framework:** Laravel 12 + Filament 5

---

## Note on Screenshots

**The `supptrax-data/Orignal/Admin` folder was reviewed but contains no screenshots.** It holds only CSV data files:
- `organizations.csv`, `organization_users.csv`, `organization_details.csv`
- `subscriptions.csv`, `invoices.csv`, `sales_representatives.csv`, `states.csv`

This UI/UX document is derived from:
1. The PRD functional requirements
2. The Admin and Client data schemas in supptrax-data
3. Filament 5 conventions and standard admin UX patterns

**When screenshots become available**, add them to `supptrax-data/Orignal/Admin/Screenshots/` and update this document with visual references.

---

## 1. Design Principles

| Principle | Description |
|-----------|-------------|
| **Clarity** | Tables and forms should be scannable; primary actions visible |
| **Consistency** | Use Filament defaults; align with existing panel (Amber primary) |
| **Efficiency** | Minimize clicks for common tasks (import, filter, export) |
| **Responsive** | Desktop-first (1024px+); mobile usable for read-only views |

---

## 2. Layout Structure

### 2.1 Shell Layout

```
┌─────────────────────────────────────────────────────────────────┐
│  [Logo]  SupptraxApp Admin                    [Search] [Avatar]  │
├──────────┬──────────────────────────────────────────────────────┤
│          │                                                        │
│ Sidebar  │  Main Content Area                                    │
│          │  (Dashboard / Resource List / Form / etc.)            │
│ - Dash   │                                                        │
│ - Claims │                                                        │
│ - Comms  │                                                        │
│ - Import │                                                        │
│ - ...    │                                                        │
│          │                                                        │
└──────────┴──────────────────────────────────────────────────────┘
```

### 2.2 Sidebar Navigation

| Item | Icon | Route | Notes |
|------|------|-------|-------|
| Dashboard | `heroicon-o-home` | `/admin` | Default landing |
| Claim Comments | `heroicon-o-chat-bubble-left-right` | `/admin/claim-comments` | Primary data |
| Claims | `heroicon-o-document-text` | `/admin/claims` | Claims board |
| Import | `heroicon-o-arrow-up-tray` | `/admin/import` or header action | CSV import |
| Statuses | `heroicon-o-tag` | `/admin/statuses` | Reference |
| Adjusters | `heroicon-o-user-group` | `/admin/adjusters` | Reference |
| Insurance Companies | `heroicon-o-building-office` | `/admin/insurance-companies` | Reference |
| Locations | `heroicon-o-map-pin` | `/admin/locations` | Reference |

**Grouping (optional):** Place Statuses, Adjusters, Insurance Companies, Locations under a collapsible "Reference Data" group.

---

## 3. Page Specifications

### 3.1 Dashboard

**Purpose:** At-a-glance overview of imported data.

**Layout:**
- Full-width; widgets in responsive grid (1–3 columns depending on viewport)
- Widgets above the fold; no horizontal scroll

**Widgets (in order):**

| Widget | Type | Data | Size |
|--------|------|------|------|
| Total Claim Comments | StatsOverview (single stat) | `ClaimComment::count()` | 1 col |
| Total Claims | StatsOverview (single stat) | `Claim::count()` | 1 col |
| Comments by Board | StatsOverview or Chart | Count per board_id (15,18,19,54,59,60) | 2 cols |
| Claims by Status | Chart (bar/donut) | Count per status abbreviation | 2 cols |
| Recent Imports | Table (last 5) | Import log: file, date, rows, errors | Full width |

**Empty state:** When no data: "No data yet. Import CSV files to get started." + CTA to Import.

---

### 3.2 Claim Comments (List)

**Purpose:** Browse, search, filter, and export scraped comments.

**Layout:**
- Filament Table resource
- Header: Title "Claim Comments" + global search + filters + Export action

**Table columns:**

| Column | Type | Sortable | Searchable | Width |
|--------|------|----------|------------|-------|
| Board | TextSelectColumn | Yes | No | 80px |
| Page | TextColumn | Yes | No | 70px |
| Index | TextColumn | Yes | No | 70px |
| Author | TextColumn | Yes | Yes | 140px |
| Text | TextColumn (truncated 80 chars) | No | Yes | Flexible |
| Timestamp | TextColumn (formatted) | Yes | No | 140px |
| Actions | View | — | — | 60px |

**Filters:**
- Board (SelectFilter: 15, 18, 19, 54, 59, 60)
- Author (SelectFilter: distinct authors)
- Date range (Filter: from / to on parsed timestamp)

**Actions:**
- **View** (per row): Opens ViewAction modal with full text, author, timestamp
- **Export** (header): Export filtered results to CSV

**Pagination:** 25 per page (default); options 10, 25, 50.

**Empty state:** "No claim comments. Import CSV files from supptrax-data."

---

### 3.3 Claim Comments (View Modal)

**Purpose:** Read full comment without leaving list.

**Layout:**
- Filament ViewAction modal
- Read-only; no edit in MVP

**Content:**
- **Author** (bold)
- **Timestamp** (formatted)
- **Text** (full, wrapped; preserve line breaks)
- **Metadata:** Board, Page, Index

---

### 3.4 Claims (List)

**Purpose:** Browse and filter claims from claims_board.

**Layout:**
- Filament Table resource
- Header: Title "Claims" + search + filters

**Table columns:**

| Column | Type | Sortable | Searchable |
|--------|------|----------|------------|
| Location | TextColumn | Yes | Yes |
| Claimant | TextColumn | Yes | Yes |
| Claim Date | TextColumn | Yes | No |
| Status | BadgeColumn (color from status) | Yes | No |
| Insurance | TextColumn | Yes | Yes |
| Adjuster | TextColumn | Yes | Yes |
| Client | TextColumn | Yes | Yes |

**Filters:**
- Status (SelectFilter)
- Location (SelectFilter)
- Insurance (SelectFilter)
- Client (SelectFilter)

**Pagination:** 25 per page.

---

### 3.5 Import

**Purpose:** Ingest CSV files from supptrax-data.

**Layout options:**
- **A)** Dedicated page `/admin/import` with cards per import type
- **B)** Header action "Import" opening modal with tabs

**Import types:**

| Type | Source files | Action |
|------|--------------|--------|
| Claim Comments | `supptrax_claim_comments_board_*.csv` | Select board or "All"; run import |
| Claims | `claims_board.csv` | Run import |
| Reference Data | statuses, adjusters, insurance, locations | Run each or "All reference" |

**UI per import:**
- File path (configurable; default: `Orignal/Client/Data/`)
- "Import" button
- Progress / result: "Imported X rows. Y errors." with optional error log link

**Validation feedback:**
- Success: Filament success notification
- Errors: List first 10 errors; "View full log" if more

---

### 3.6 Reference Data (Statuses, Adjusters, Insurance Companies, Locations)

**List view:** Filament Table with columns matching CSV schema.  
**CRUD (Phase 4):** Standard Filament Create/Edit forms.  
**Import:** Via Import page; no inline import on these resources in MVP.

---

## 4. Component Specifications

### 4.1 Tables

- **Striped rows** (optional): Alternate row background for readability
- **Sticky header:** Header remains visible on scroll
- **Bulk actions:** Not required for MVP
- **Column toggle:** Optional for Claims (many columns)

### 4.2 Forms (Import, future CRUD)

- **Labels** above fields
- **Help text** for file path: "Path to CSV directory (e.g. ../supptrax-data/Orignal/Client/Data)"
- **Validation:** Inline errors; prevent submit if invalid

### 4.3 Modals

- **View Comment:** Max height 70vh; scrollable body
- **Import:** Max width 500px; tabs if multiple import types

### 4.4 Notifications

- **Success:** "X claim comments imported successfully."
- **Error:** "Import failed: [reason]"
- **Warning:** "Y rows skipped due to validation errors."

---

## 5. Visual Design

### 5.1 Theme (Filament)

- **Primary color:** Amber (existing `AdminPanelProvider`)
- **Dark mode:** Support if Filament theme allows
- **Typography:** Filament defaults (Inter or system font)

### 5.2 Status Colors (Claims)

Map status abbreviations to Filament/Badge colors:

| Status | Color |
|--------|-------|
| SS (Supplement Settled) | success |
| ESTI (Estimate Sent) | info |
| WSC (Written Supp. Complete) | primary |
| CBC (Cancelled By Contractor) | danger |
| NONE | gray |
| Others | warning or default |

### 5.3 Spacing & Density

- **Table row height:** Comfortable (min 44px tap target)
- **Card padding:** 1.5rem
- **Section gaps:** 1rem between widgets/sections

---

## 6. Interaction Patterns

### 6.1 Search

- **Global search (optional):** Search across Claim Comments and Claims
- **Resource search:** Debounced 300ms; search on Author, Text (comments); Claimant, Location, etc. (claims)

### 6.2 Filters

- **Persist:** Optional—remember last filters in session
- **Clear:** "Clear filters" link when any filter active
- **Badge:** Show active filter count on filter trigger

### 6.3 Export

- **Format:** CSV
- **Scope:** Current filtered results (respect filters)
- **Filename:** `claim_comments_export_YYYY-MM-DD.csv`

---

## 7. Accessibility

- **Keyboard:** All actions reachable via keyboard
- **Focus:** Visible focus ring on interactive elements
- **Labels:** All form fields and icon buttons have accessible names
- **Tables:** Proper `th` scope; avoid complex multi-level headers

---

## 8. Admin Data (Orignal/Admin) – Future Scope

The `Orignal/Admin` CSV files suggest a **platform admin** layer (organizations, subscriptions, invoices, sales reps). This is out of scope for the current PRD but can extend the Admin Panel later:

| Data | Potential UI |
|------|---------------|
| Organizations | List + detail; filter by status |
| Organization Users | Nested under Organization or separate list |
| Subscriptions | List with status, dates, model |
| Invoices | List with amount, status, link to PDF |
| Sales Representatives | List; link to subscriptions |

When adding these, follow the same layout and component patterns above.

---

## 9. Screenshot Placeholder

When screenshots are added, place them in:

```
supptrax-data/Orignal/Admin/Screenshots/
├── 01-dashboard.png
├── 02-claim-comments-list.png
├── 03-claim-comments-view.png
├── 04-claims-list.png
├── 05-import.png
└── 06-reference-data.png
```

Update this section with inline references, e.g.:

> ![Dashboard](../supptrax-data/Orignal/Admin/Screenshots/01-dashboard.png)

---

## 10. Revision History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2026-03-04 | Initial UI/UX doc; no screenshots in Orignal/Admin |
