# UI/UX Document: SupptraxApp Admin Panel

**Version:** 1.1  
**Date:** March 4, 2026  
**Related:** [PRD-supptraxapp.md](./PRD-supptraxapp.md)  
**Framework:** Laravel 12 + Filament 5  
**Reference:** Supptrax Admin Panel (admin.supptrax.com) screenshots

---

## Screenshot Reference

Screenshots from the Supptrax Admin Panel are in the **supptrax-data** workspace at **`Orignal/Admin/ScreenShots/`** and serve as the visual reference for this document.

| Screenshot | Path | Description |
|------------|------|-------------|
| Dashboard | `supptrax-data/Orignal/Admin/ScreenShots/dashboard.png` | Main dashboard with Total Organizations, Claims per organization, Top 3 Organizations |
| Organizations | `supptrax-data/Orignal/Admin/ScreenShots/organizations.png` | Organizations table (name, sales person, status, actions) |
| Invoices | `supptrax-data/Orignal/Admin/ScreenShots/invoices.png` | Invoices table (org, invoice #, date, amount, status, download) |
| Subscriptions | `supptrax-data/Orignal/Admin/ScreenShots/subscriptions.png` | Subscriptions table (org, created, duration, model, status) |
| Sales Representative | `supptrax-data/Orignal/Admin/ScreenShots/sales-representative.png` | Sales reps table (name, leads, trial period, link, actions) |

**Additional screenshots** (subfolders): `Dashboard/`, `Organizations/`, `Invoices/`, `Subscriptions/`, `SalesRepresentative/`

---

## 1. Supptrax Admin Panel – Reference Design (from Screenshots)

The Supptrax Admin Panel (admin.supptrax.com) provides the visual and interaction reference for SupptraxApp. Key elements observed:

### 1.1 Layout

- **Left sidebar:** Fixed navigation; dark charcoal background; logo at top
- **Main content:** Full-width; page title top-left; utility icons top-right
- **Header utilities:** Moon (dark/light toggle), Bell (notifications), User avatar

### 1.2 Navigation (Sidebar)

| Item | Icon | Active State |
|------|------|--------------|
| Dashboard | Grid/squares | Orange highlight + orange icon |
| Organizations | Group/people | — |
| Subscriptions | Document/credit card | — |
| Invoices | Dollar sign in circle | — |
| Sales representative | Person/search | — |

### 1.3 Dashboard Widgets

- **Total Organizations:** Large number (e.g. 110), "View all" button (orange), icon
- **Claims per organization:** List of orgs with claim count + "Manage" button per row
- **Top 3 Organizations:** Ranked list (1–3) with orange highlight for #1; shows claims, New/Working/Closed breakdown

### 1.4 Table Pages (Organizations, Invoices, Subscriptions, Sales Reps)

- **Header:** Page title + primary action (e.g. "Create Organization", "Create Sales Representative")
- **Search:** Magnifying glass + placeholder "Search" (Sales Reps page)
- **Table:** Uppercase column headers; row actions via ellipsis (⋯) or "Download" link
- **Status colors:** Green = Active/Paid; Orange = Inactive/Warning; Grey = Canceled/Unpaid
- **Pagination:** Numbered circles (1, 2, 3); prev/next arrows; current page in orange

### 1.5 Color Palette

| Element | Color |
|---------|-------|
| Background | Dark grey/charcoal |
| Sidebar | Slightly lighter dark grey |
| Accent / Primary | Orange |
| Active nav / CTA buttons | Orange |
| Success (Active, Paid) | Green |
| Warning (Inactive) | Orange |
| Text primary | White |
| Text secondary | Light grey |

---

## 2. Design Principles

| Principle | Description |
|-----------|-------------|
| **Clarity** | Tables and forms should be scannable; primary actions visible |
| **Consistency** | Match Supptrax Admin reference: dark theme, orange accent, side nav |
| **Efficiency** | Minimize clicks for common tasks (import, filter, export) |
| **Responsive** | Desktop-first (1024px+); mobile usable for read-only views |

---

## 3. Layout Structure

### 3.1 Shell Layout

```
┌─────────────────────────────────────────────────────────────────┐
│  [Logo]  SupptraxApp Admin         [Moon] [Bell] [Avatar]       │
├──────────┬──────────────────────────────────────────────────────┤
│          │  Page Title                    [Primary Action]        │
│ Sidebar  ├──────────────────────────────────────────────────────┤
│          │                                                        │
│ - Dash   │  Main Content Area                                    │
│ - Claims │  (Dashboard / Resource List / Form / etc.)             │
│ - Comms  │                                                        │
│ - Import │                                                        │
│ - ...    │                                                        │
│          │                                                        │
└──────────┴──────────────────────────────────────────────────────┘
```

### 3.2 Sidebar Navigation

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

## 4. Page Specifications

### 4.1 Dashboard

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

**Reference:** See `supptrax-data/Orignal/Admin/ScreenShots/dashboard.png` for card layout and "View all" / "Manage" buttons.

---

### 4.2 Claim Comments (List)

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

**Reference:** See `supptrax-data/Orignal/Admin/ScreenShots/organizations.png` for table layout, ellipsis actions, status colors.

---

### 4.3 Claim Comments (View Modal)

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

### 4.4 Claims (List)

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

**Reference:** See `supptrax-data/Orignal/Admin/ScreenShots/organizations.png` for table layout, pagination.

---

### 4.5 Import

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

### 4.6 Reference Data (Statuses, Adjusters, Insurance Companies, Locations)

**List view:** Filament Table with columns matching CSV schema.  
**CRUD (Phase 4):** Standard Filament Create/Edit forms.  
**Import:** Via Import page; no inline import on these resources in MVP.

---

## 5. Component Specifications

### 5.1 Tables

- **Striped rows** (optional): Alternate row background for readability
- **Sticky header:** Header remains visible on scroll
- **Bulk actions:** Not required for MVP
- **Column toggle:** Optional for Claims (many columns)

### 5.2 Forms (Import, future CRUD)

- **Labels** above fields
- **Help text** for file path: "Path to CSV directory (e.g. ../supptrax-data/Orignal/Client/Data)"
- **Validation:** Inline errors; prevent submit if invalid

### 5.3 Modals

- **View Comment:** Max height 70vh; scrollable body
- **Import:** Max width 500px; tabs if multiple import types

### 5.4 Notifications

- **Success:** "X claim comments imported successfully."
- **Error:** "Import failed: [reason]"
- **Warning:** "Y rows skipped due to validation errors."

---

## 6. Visual Design

### 6.1 Theme (from Supptrax Admin Screenshots)

- **Primary/accent:** Orange (buttons, active nav, highlights)
- **Background:** Dark grey/charcoal
- **Sidebar:** Slightly lighter dark grey
- **Dark mode:** Default (supptrax admin is dark); light mode via moon toggle
- **Typography:** Clean sans-serif; white for primary text, light grey for secondary

**Filament:** Configure Amber primary color to match Supptrax orange; enable dark mode if available.

### 6.2 Status Colors (Claims)

Map status abbreviations to Filament/Badge colors:

| Status | Color |
|--------|-------|
| SS (Supplement Settled) | success |
| ESTI (Estimate Sent) | info |
| WSC (Written Supp. Complete) | primary |
| CBC (Cancelled By Contractor) | danger |
| NONE | gray |
| Others | warning or default |

**Supptrax reference:** Green = Active/Paid; Orange = Inactive/Warning; Grey = Canceled/Unpaid.

### 6.3 Spacing & Density

- **Table row height:** Comfortable (min 44px tap target)
- **Card padding:** 1.5rem
- **Section gaps:** 1rem between widgets/sections

---

## 7. Interaction Patterns

### 7.1 Search

- **Global search (optional):** Search across Claim Comments and Claims
- **Resource search:** Debounced 300ms; search on Author, Text (comments); Claimant, Location, etc. (claims)

**Reference:** See `supptrax-data/Orignal/Admin/ScreenShots/sales-representative.png` for search bar placement.

### 7.2 Filters

- **Persist:** Optional—remember last filters in session
- **Clear:** "Clear filters" link when any filter active
- **Badge:** Show active filter count on filter trigger

### 7.3 Export

- **Format:** CSV
- **Scope:** Current filtered results (respect filters)
- **Filename:** `claim_comments_export_YYYY-MM-DD.csv`

**Reference:** See `supptrax-data/Orignal/Admin/ScreenShots/invoices.png` for "Download" link-style action.

---

## 8. Accessibility

- **Keyboard:** All actions reachable via keyboard
- **Focus:** Visible focus ring on interactive elements
- **Labels:** All form fields and icon buttons have accessible names
- **Tables:** Proper `th` scope; avoid complex multi-level headers

---

## 9. Platform Admin (Orignal/Admin) – Future Scope

The Supptrax Admin screenshots show the **platform admin** UI. These map to `supptrax-data/Orignal/Admin` CSV data:

| Screen | Data | Columns / Actions |
|--------|------|-------------------|
| **Organizations** | `organizations.csv` | Organization Name, Sales Person, Status, Actions (⋯) |
| **Subscriptions** | `subscriptions.csv` | Organization Name, Created, Subscription Duration, Model, Status |
| **Invoices** | `invoices.csv` | Organization Name, Invoice Number, Date, Amount, Status, Download |
| **Sales Representative** | `sales_representatives.csv` | Name, Number of Leads, Trial Period, Link, Actions (⋯) |

**Screenshots:** `supptrax-data/Orignal/Admin/ScreenShots/dashboard.png`, `organizations.png`, `invoices.png`, `subscriptions.png`, `sales-representative.png`

**Subfolders:** `Dashboard/`, `Organizations/`, `Invoices/`, `Subscriptions/`, `SalesRepresentative/` (create forms, row menus, etc.)

---

## 10. Screenshot Index

| File | Description |
|------|-------------|
| `supptrax-data/Orignal/Admin/ScreenShots/dashboard.png` | Main dashboard |
| `supptrax-data/Orignal/Admin/ScreenShots/organizations.png` | Organizations table |
| `supptrax-data/Orignal/Admin/ScreenShots/invoices.png` | Invoices table |
| `supptrax-data/Orignal/Admin/ScreenShots/subscriptions.png` | Subscriptions table |
| `supptrax-data/Orignal/Admin/ScreenShots/sales-representative.png` | Sales reps table |
| `Organizations/create-organization.png` | Create organization form |
| `Organizations/organization-row-menu.png` | Row actions menu |
| `Organizations/organization-details-click.png` | Organization details |
| `Invoices/invoice-download-clicked.png` | Download action |
| `SalesRepresentative/create-sales-representative.png` | Create sales rep form |

---

## 11. Revision History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2026-03-04 | Initial UI/UX doc; no screenshots in Orignal/Admin |
| 1.1 | 2026-03-04 | Added Supptrax Admin reference from ScreenShots; dark theme, orange accent; screenshot index |
