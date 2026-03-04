# Development Plan: SupptraxApp Admin Panel

**Version:** 1.0  
**Date:** March 4, 2026  
**Reference:** [PRD](./PRD-supptraxapp.md), [UI/UX](./UI-UX-Admin-Panel.md), Supptrax Admin Screenshots  
**Stack:** Laravel 12, Filament 5, PHP 8.2+

---

## 1. Overview

This plan delivers a complete Admin Panel matching the Supptrax Admin design (dark theme, orange accent) and managing all entities from both **Platform Admin** (Organizations, Subscriptions, Invoices, Sales Representatives) and **Claims/Client** (Claims, Claim Comments, Statuses, Adjusters, Insurance Companies, Locations).

---

## 2. Entity Model & Relationships

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                        PLATFORM ADMIN ENTITIES                                    │
├─────────────────────────────────────────────────────────────────────────────────┤
│                                                                                  │
│  SalesRepresentative ──┬──< Organization (sales_person_id)                       │
│                        │                                                         │
│  Organization ─────────┼──< OrganizationUser                                     │
│       │                │                                                         │
│       │                └──< Subscription (organization_id)                       │
│       │                     Invoice (organization_id)                             │
│       │                                                                          │
│       └──< Claim (location = organization_name)  [via location string]          │
│                                                                                  │
└─────────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────────┐
│                        CLAIMS / CLIENT ENTITIES                                   │
├─────────────────────────────────────────────────────────────────────────────────┤
│                                                                                  │
│  Board (15,18,19,54,59,60) ──< ClaimComment (board_id)                           │
│                                                                                  │
│  Status ──< Claim (status_id)                                                    │
│  Location ──< Claim (location_id)                                                │
│  InsuranceCompany ──< Claim (insurance_company_id)                               │
│  Adjuster ──< Claim (adjuster_id)                                                │
│                                                                                  │
└─────────────────────────────────────────────────────────────────────────────────┘
```

---

## 3. Database Schema

### 3.1 Platform Admin Tables

| Table | Key Columns |
|-------|-------------|
| `sales_representatives` | id, name, number_of_leads, trial_period, link, created_at, updated_at |
| `organizations` | id, name, sales_representative_id, status, date_of_registration, organization_address, organization_zip, organization_state, billing_address, billing_zip, billing_state, contact_full_name, contact_phone, contact_email, created_at, updated_at |
| `organization_users` | id, organization_id, user_name, user_email, created_at, updated_at |
| `subscriptions` | id, organization_id, created_at, subscription_start, subscription_end, subscription_model, status, created_at, updated_at |
| `invoices` | id, organization_id, invoice_number, date, amount, status, file_path (nullable), created_at, updated_at |

### 3.2 Claims / Client Tables

| Table | Key Columns |
|-------|-------------|
| `boards` | id, board_id (15,18,19,54,59,60), name, created_at, updated_at |
| `claim_comments` | id, board_id, page, index, author, text, commented_at (datetime), source_file, created_at, updated_at |
| `statuses` | id, name, abbreviation, color, description, sort_order, created_at, updated_at |
| `locations` | id, name, total_claims, show_board, created_at, updated_at |
| `insurance_companies` | id, name, location, phone_number, email, adjusters_count, created_at, updated_at |
| `adjusters` | id, name, company_name, email, phone_number, insurance_company_id (nullable), created_at, updated_at |
| `claims` | id, location_id, claimant, claim_date, submission_date, funding_date, status_id, insurance_company_id, adjuster_id, adjuster_phone, claim_handler, client, created_at, updated_at |

### 3.3 Support Tables

| Table | Key Columns |
|-------|-------------|
| `states` | id, name, code |
| `import_logs` | id, type, file_path, rows_imported, rows_failed, errors_json, run_at, created_at |

---

## 4. Implementation Phases

### Phase 1: Foundation & Platform Admin (Weeks 1–2)

**Goal:** Match Supptrax Admin screenshots (Dashboard, Organizations, Subscriptions, Invoices, Sales Representatives).

| Task | Details | Est. |
|------|---------|------|
| 1.1 Migrations | Create migrations for sales_representatives, organizations, organization_users, subscriptions, invoices, states | 1 day |
| 1.2 Models | Eloquent models with relationships, fillable, casts | 1 day |
| 1.3 Sales Rep Resource | Filament Resource: list, create, edit, delete; table columns: name, number_of_leads, trial_period, link; Actions (⋯) | 0.5 day |
| 1.4 Organization Resource | Filament Resource: list, create, edit, view; columns: name, sales_person, status; Status BadgeColumn; Actions (⋯); relation to SalesRep | 1 day |
| 1.5 Organization Users | Repeater on Organization form, or separate RelationManager | 0.5 day |
| 1.6 Subscription Resource | Filament Resource: list (org, created, duration, model, status); relation to Organization | 0.5 day |
| 1.7 Invoice Resource | Filament Resource: list (org, invoice_number, date, amount, status); Download action (link or file); relation to Organization | 0.5 day |
| 1.8 Dashboard Widgets | Total Organizations (StatsOverview + View all); Claims per organization (list + Manage); Top 3 Organizations (ranked cards) | 1 day |
| 1.9 Theme | Dark mode, orange primary; Filament v3 dark theme config | 0.5 day |
| 1.10 Navigation | Sidebar: Dashboard, Organizations, Subscriptions, Invoices, Sales representative | 0.5 day |

**Deliverables:** Admin panel matching Supptrax screenshots for Platform Admin entities.

---

### Phase 2: Claims & Claim Comments (Weeks 3–4)

**Goal:** Add Claims and Claim Comments from scraped data.

| Task | Details | Est. |
|------|---------|------|
| 2.1 Migrations | boards, claim_comments, statuses, locations, insurance_companies, adjusters, claims, import_logs | 1 day |
| 2.2 Models | ClaimComment, Claim, Status, Location, InsuranceCompany, Adjuster, Board | 1 day |
| 2.3 Claim Comment Resource | List (board, page, index, author, text truncated, timestamp); ViewAction; filters: board, author, date range; search; Export action | 1 day |
| 2.4 Claim Resource | List (location, claimant, claim_date, status, insurance, adjuster, client); filters: status, location, insurance, client; Status BadgeColumn | 1 day |
| 2.5 CSV Import – Claim Comments | Import from supptrax_claim_comments_board_*.csv; parse timestamps; store board_id; idempotent (board+page+index) | 1 day |
| 2.6 CSV Import – Claims | Import claims_board.csv; map status, location, insurance, adjuster; handle "-" for empty dates | 1 day |
| 2.7 Import Page/Action | Dedicated Import page or header action; select import type; configurable CSV path; progress/result feedback | 0.5 day |
| 2.8 Dashboard Updates | Add Total Claim Comments, Total Claims, Comments by Board, Claims by Status widgets | 0.5 day |
| 2.9 Navigation | Add Claim Comments, Claims, Import to sidebar | 0.5 day |

**Deliverables:** Claim Comments and Claims CRUD; CSV import; dashboard widgets.

---

### Phase 3: Reference Data & Import (Week 5)

**Goal:** Reference data resources and full import pipeline.

| Task | Details | Est. |
|------|---------|------|
| 3.1 Status Resource | List, create, edit; columns: name, abbreviation, color, description | 0.5 day |
| 3.2 Adjuster Resource | List, create, edit; columns: name, company, email, phone; relation to InsuranceCompany | 0.5 day |
| 3.3 Insurance Company Resource | List, create, edit; columns: name, location, phone, email, adjusters_count | 0.5 day |
| 3.4 Location Resource | List, create, edit; columns: name, total_claims, show_board | 0.5 day |
| 3.5 CSV Import – Reference | Import statuses_manage, adjusters, insurance_companies, locations | 1 day |
| 3.6 Import Log | Log each import run; display last 5 on dashboard | 0.5 day |
| 3.7 States Seeder | Seed states from states.csv | 0.5 day |
| 3.8 Platform Admin CSV Import | Import organizations, organization_users, subscriptions, invoices, sales_representatives | 1 day |

**Deliverables:** All reference data CRUD; full CSV import for all entities; import log.

---

### Phase 4: Polish & Enhancements (Week 6)

**Goal:** Export, dark theme refinement, notifications, validation.

| Task | Details | Est. |
|------|---------|------|
| 4.1 Export to CSV | Claim Comments export (filtered results); Filament ExportAction | 0.5 day |
| 4.2 Invoice Download | Store invoice PDF path or generate; Download action | 0.5 day |
| 4.3 Dark Theme | Filament dark mode; match Supptrax color palette | 0.5 day |
| 4.4 Form Validation | Validation rules for all create/edit forms | 0.5 day |
| 4.5 Empty States | Custom empty state messages; CTA to Import | 0.5 day |
| 4.6 Pagination | Match Supptrax style (numbered circles, arrows) | 0.5 day |
| 4.7 Search | Global search (optional); resource-level search | 0.5 day |

**Deliverables:** Production-ready admin panel.

---

## 5. File Structure

```
app/
├── Models/
│   ├── SalesRepresentative.php
│   ├── Organization.php
│   ├── OrganizationUser.php
│   ├── Subscription.php
│   ├── Invoice.php
│   ├── Board.php
│   ├── ClaimComment.php
│   ├── Claim.php
│   ├── Status.php
│   ├── Location.php
│   ├── InsuranceCompany.php
│   ├── Adjuster.php
│   ├── State.php
│   └── ImportLog.php
├── Filament/
│   ├── Resources/
│   │   ├── SalesRepresentativeResource.php
│   │   ├── OrganizationResource.php
│   │   ├── SubscriptionResource.php
│   │   ├── InvoiceResource.php
│   │   ├── ClaimCommentResource.php
│   │   ├── ClaimResource.php
│   │   ├── StatusResource.php
│   │   ├── AdjusterResource.php
│   │   ├── InsuranceCompanyResource.php
│   │   └── LocationResource.php
│   ├── Resources/OrganizationResource/
│   │   └── RelationManagers/
│   │       └── OrganizationUsersRelationManager.php
│   ├── Pages/
│   │   └── Import.php (custom page)
│   └── Widgets/
│       ├── TotalOrganizationsWidget.php
│       ├── ClaimsPerOrganizationWidget.php
│       ├── TopOrganizationsWidget.php
│       ├── TotalClaimCommentsWidget.php
│       ├── TotalClaimsWidget.php
│       ├── CommentsByBoardWidget.php
│       ├── ClaimsByStatusWidget.php
│       └── RecentImportsWidget.php
├── Services/
│   └── CsvImportService.php (or Import/)
│       ├── ClaimCommentsImporter.php
│       ├── ClaimsImporter.php
│       ├── OrganizationsImporter.php
│       ├── SubscriptionsImporter.php
│       ├── InvoicesImporter.php
│       ├── SalesRepresentativesImporter.php
│       └── ReferenceDataImporter.php
database/
├── migrations/
│   ├── create_sales_representatives_table.php
│   ├── create_organizations_table.php
│   ├── create_organization_users_table.php
│   ├── create_subscriptions_table.php
│   ├── create_invoices_table.php
│   ├── create_states_table.php
│   ├── create_boards_table.php
│   ├── create_claim_comments_table.php
│   ├── create_statuses_table.php
│   ├── create_locations_table.php
│   ├── create_insurance_companies_table.php
│   ├── create_adjusters_table.php
│   ├── create_claims_table.php
│   └── create_import_logs_table.php
└── seeders/
    ├── BoardSeeder.php
    └── StateSeeder.php
config/
└── supptrax.php (csv_path, etc.)
```

---

## 6. Key Implementation Details

### 6.1 Organization Status

```php
// Enum or config
'Active' => 'success',
'Inactive' => 'warning',
'Canceled' => 'gray',
'Unpaid' => 'warning',
'Trialing' => 'info',
```

### 6.2 Invoice Status

```php
'Paid' => 'success',
'Open' => 'warning',
```

### 6.3 Claim Status (from statuses_manage)

Map abbreviation to color: SS→success, ESTI→info, WSC→primary, CBC→danger, NONE→gray.

### 6.4 Timestamp Parsing (Claim Comments)

```php
// Support: "Mar 02, 2026 15:53", "Feb 28, 2026 • 20:15"
Carbon::parse(str_replace('•', '', $timestamp));
```

### 6.5 CSV Parser

Use `league/csv` for robust parsing (handles multiline, quoted fields).

```bash
composer require league/csv
```

### 6.6 Config

```php
// config/supptrax.php
return [
    'csv_path' => env('SUPPTRAX_CSV_PATH', base_path('../supptrax-data/Orignal')),
];
```

---

## 7. Filament Resource Checklist (per Resource)

- [ ] `$model` and `$navigationIcon`
- [ ] `$navigationGroup` (e.g. "Platform Admin", "Claims", "Reference Data")
- [ ] `table()` columns with correct types
- [ ] `filters()` where needed
- [ ] `form()` for create/edit
- [ ] `actions()` – View, Edit, Delete, Export (where applicable)
- [ ] `getRelations()` for RelationManagers
- [ ] Search on relevant columns
- [ ] Pagination (default 25)

---

## 8. Dashboard Widget Checklist

| Widget | Data Source | Link |
|--------|-------------|------|
| Total Organizations | `Organization::count()` | → Organizations index |
| Claims per organization | `Claim::selectRaw('location_id, count(*) as total')->groupBy('location_id')->with('location')` | → Manage (filter claims by location) |
| Top 3 Organizations | Rank by claim count; show New/Working/Closed if available | — |
| Total Claim Comments | `ClaimComment::count()` | → Claim Comments index |
| Total Claims | `Claim::count()` | → Claims index |
| Comments by Board | `ClaimComment::selectRaw('board_id, count(*)')->groupBy('board_id')` | — |
| Claims by Status | `Claim::selectRaw('status_id, count(*)')->groupBy('status_id')` | — |
| Recent Imports | `ImportLog::latest()->take(5)` | — |

---

## 9. Navigation Structure (Final)

```
Dashboard
---
Organizations
Subscriptions
Invoices
Sales representative
---
Claim Comments
Claims
Import
---
Reference Data (group)
  ├── Statuses
  ├── Adjusters
  ├── Insurance Companies
  └── Locations
```

---

## 10. Dependencies

```json
{
  "league/csv": "^9.0"
}
```

---

## 11. Environment Variables

```env
SUPPTRAX_CSV_PATH=/path/to/supptrax-data/Orignal
```

---

## 12. Testing Checklist

- [ ] All migrations run cleanly
- [ ] CSV import for each entity type
- [ ] Idempotent re-import (no duplicates)
- [ ] Dashboard widgets render
- [ ] All CRUD operations work
- [ ] Filters and search work
- [ ] Export produces valid CSV
- [ ] Dark theme displays correctly

---

## 13. Timeline Summary

| Phase | Duration | Focus |
|-------|----------|-------|
| Phase 1 | 2 weeks | Platform Admin (Orgs, Subs, Invoices, Sales Reps) + Dashboard |
| Phase 2 | 2 weeks | Claims, Claim Comments, CSV Import |
| Phase 3 | 1 week | Reference Data, Full Import |
| Phase 4 | 1 week | Polish, Export, Theme |

**Total:** ~6 weeks for complete Admin Panel.
