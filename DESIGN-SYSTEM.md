# Timetable — Design System & Page Structure (v2 · Bento Pastel)

> Handoff document describing the current UI architecture, tokens, and page structure.
> Written so an AI agent can read this and generate a `DESIGN.md` (or extend the UI) without breaking the existing system.
>
> **Source of truth:** the user's `DESIGN.md` (v2, Bento Pastel). This file reflects what is actually implemented.

---

## 1. Project shape

A **timetable management admin** on top of the Laravel Livewire Starter Kit.

- **Backend:** Laravel 13 · PHP 8.3+ · MySQL (`laravel1st`) · Fortify (auth) · Livewire 4
- **Frontend:** **two separate UI stacks** (see §2) — the single most important fact about the project.
- **Fonts:** Instrument Sans (400/500/600/700), Google Fonts (admin) + Bunny (Flux).
- **Icons:** Font Awesome 5 (admin) + Flux icons (Flux).

### Design direction

> **Reading this as:** a staff dashboard that feels *friendly, not corporate* — utilitarian content, playful container.

- **Boldness in one place:** the pastel bento grid. Nav, table, footer stay quiet.
- **Primary action = ink (black) pill.** Indigo is only for active/info states (time badges, focus ring, links).
- **Banned:** gradients, glow, emoji-as-icon, uppercase/tracked labels, `transition: all`.

---

## 2. Two UI stacks (critical)

| | **Stack A — AdminLTE / Bootstrap 4** | **Stack B — Flux / Tailwind v4** |
|---|---|---|
| Layout | `resources/views/layouts/template.blade.php` | `layouts/app.blade.php`, `layouts/auth.blade.php` |
| Stylesheet | `public/css/theme.css` + vendor `adminlte.min.css` (Bootstrap base only) | `resources/css/app.css` (Tailwind `@theme` + Flux) |
| Icons | Font Awesome (`fas fa-*`) | Flux (`<flux:icon.*>`) |
| Build | **static** (no Vite — plain `<link>`) | Vite (`npm run build`) |
| Pages | home, forms, student, **all 24 CRUD views** | dashboard, settings, auth (login/register/…) |

**Rule:** the two stacks do **not** share CSS. Admin pages are Bootstrap classes; Flux pages are Tailwind/Flux components. Unified only by *intent* (same palette, same font, same accent).

---

## 3. Design tokens (`public/css/theme.css`, Stack A)

### Core (light / dark)

| Token | Light | Dark | Use |
|---|---|---|---|
| `--ink` | `#0f172a` | `#f1f5f9` | headings, primary button bg |
| `--ink-soft` | `#1e293b` | `#e2e8f0` | body |
| `--muted` | `#64748b` | `#94a3b8` | secondary text, table heads |
| `--faint` | `#94a3b8` | `#64748b` | placeholder |
| `--line` | `#e2e8f0` | `#1e293b` | borders |
| `--paper` | `#f8fafc` | `#0b1120` | page bg |
| `--surface` / `--surface-2` | `#fff` / `#f1f5f9` | `#111a2e` / `#18233b` | panels, hover |
| `--brand` / `--brand-soft` | `#4f46e5` / `#eef2ff` | `#818cf8` / `#1e1b4b` | active, badges, focus |
| `--chip` | `rgba(255,255,255,.72)` | `rgba(15,23,42,.45)` | inner fill on tiles |

Semantic (`--ok`, `--danger`, `--warn`, `--info` + `-soft`) — alerts only, never tiles.

### Tile palette (each sets `--tb` bg + `--ti` text)

| Name | Light bg / text | Dark bg / text | Typical content |
|---|---|---|---|
| `lav` | `#cfc7f0` / `#2e2468` | `#3a3274` / `#e4defc` | week overview (hero tile) |
| `pink` | `#f4a6c0` / `#5a1c38` | `#6e2f4b` / `#fcd9e6` | next class, time-critical |
| `green` | `#c9dca0` / `#2f4012` | `#3d4b24` / `#e3f0c4` | halls |
| `yellow` | `#fbe48a` / `#4d3b05` | `#5d4a14` / `#fdf0b8` | groups |
| `orange` | `#f5aa7c` / `#5a2a0a` | `#6e3b1d` / `#fde0cb` | subjects |
| `blue` | `#bcd2e4` / `#1b3550` | `#25384d` / `#d3e6f5` | sessions / reminders |

### Radius scale

| Token | Value | Use |
|---|---|---|
| `--r-xl` | `28px` | bento tiles, panels |
| `--r-lg` | `20px` | cards, large inputs |
| `--r-md` | `14px` | inner slots, list items |
| `--r-sm` | `10px` | inputs, small controls |
| `--r-pill` | `999px` | buttons, badges, nav, chips |

Nested rule: inner radius is one step below its parent.

### Elevation

Flat at rest. Hover lift: `--shadow: 0 12px 32px -16px rgba(15,23,42,.22)` + `translateY(-3px)`.

### Type

Instrument Sans only. Sentence case everywhere. `font-variant-numeric: tabular-nums` on body.

| Role | Size / weight |
|---|---|
| Hero h1 | `clamp(40px, 6vw, 68px)` / 600, `-.035em`, line-height `.98`, max `11ch` |
| Tile title | 24px / 600, `-.02em` |
| Big number | 64px / 600, `-.04em` |
| Body | 15px / 400, line-height 1.5 |

---

## 4. Shell & layout

- `.shell` — 2-column grid: `260px` sidebar + fluid main.
- `.side` — sticky sidebar (surface bg, 1px right border): logo → primary pill button → pill nav → user + theme toggle + logout at bottom.
- `.main > .wrap` — max-width `1180px`, padding `32px`.
- **No top bar.** Page-level actions live in the `.hero` (right side).

### Bento grid (`.grid`)

12-column CSS grid, `gap: 16px`, `grid-auto-rows: minmax(190px, auto)`.

| Tile | Grid placement |
|---|---|
| `week` | 1/8, rows 1–2 |
| `next` | 8/13, row 1 |
| `halls` | 8/10, row 2 |
| `groups` | 10/13, row 2 |
| `subjects` | 1/8, row 3 |
| `sessions` | 8/13, row 3 |
| upcoming (panel) | full width |

Under `900px`: sidebar becomes a static top strip, nav becomes a horizontal pill row, every tile spans 12 (halls/groups span 6), and the week grid scrolls horizontally inside its tile.

---

## 5. Components (Stack A)

| Component | Class | Rules |
|---|---|---|
| Sidebar | `.side`, `.nav`, `.side-foot` | 260px, logo, primary pill button, pill nav, user + theme toggle + logout bottom |
| Nav item | `.nav a` | pill, 8px colour dot; active = ink pill |
| Primary button | `.btn` | ink bg, `--r-pill`, weight 600, `:active translateY(1px)` |
| Ghost button | `.btn.ghost` | surface bg, 1px inset line |
| Bento tile | `.tile` + `.tile-lav/pink/green/yellow/orange/blue` | `--r-xl`, padding 24, min-height 200, hover lift |
| Tile tag | `.tag` | pill, `--chip` bg, 12px/600 |
| Arrow | `.arrow` | 30px circle, `--chip` bg, marks a link tile |
| Slot | `.slot`, `.slot.free` | `--r-md`; free = outlined |
| Chip | `.chip` | pill with dot (subjects) |
| Panel | `.panel` | surface bg, 1px inset line, `--r-xl` |
| Table | `.tbl` | sentence-case heads, row hover `--surface-2`, no zebra |
| Time badge | `.time-badge` | `--brand-soft` bg, `--brand` text, pill |
| Hero | `.hero` | huge h1 left, actions right |

### Bootstrap aliases (still styled for legacy views)

`.table` (→ `.tbl` look), `.card`, `.form-control`, `.alert`, `.nav-tabs`, `.btn-primary` (→ ink), `.btn-info`/`.btn-success`/`.btn-light` (→ ghost), `.btn-danger`.

---

## 6. Page structure (route → view → layout)

### Admin (Stack A) — all `@extends('layouts.template')`

| Route | View | Notes |
|---|---|---|
| `/home` | `home.blade.php` | **Signature dashboard** — `.hero` + 6 pastel tiles + upcoming panel |
| `/forms` | `forms.blade.php` | 5 tabbed forms |
| `/home/student` | `student.blade.php` | bare stub (standalone, no layout) |
| `/students` | `students/index.blade.php` → `students/table.blade.php` | list |
| `/students/create·edit·show` | `students/{create,edit,show}.blade.php` | card-based forms |
| `/subjects`, `/halls`, `/groups`, `/days`, `/timetables` (CRUD) | `<resource>/{index,create,edit,show}.blade.php` | `.hero` + `.panel` + `.tbl` |

### Flux (Stack B)

| Route | View / Layout |
|---|---|
| `/dashboard` | `dashboard.blade.php` → `layouts::app` |
| `/settings/*` | `pages/settings/*.blade.php` → `layouts::app` |
| auth (login/register/…) | `pages/auth/*.blade.php` → `layouts::auth` |

---

## 7. States

| State | Rule |
|---|---|
| Loading | `.skeleton` shimmer inside tile; `.btn.is-loading` + `.spinner` on form submit |
| Empty | one sentence + action ("No classes yet. Add your first one.") |
| Error | soft-tint alert, no border |
| Tactile | buttons press down 1px; tiles lift 3px on hover |
| Focus | `:focus-visible` 2px `--brand` outline, offset 2px |

---

## 8. Dark mode

- Admin (Stack A): `.dark` class on `<html>`, navbar/sidebar toggle, persisted in `localStorage['theme']`, respects `prefers-color-scheme`.
- Flux (Stack B): dark-first (`class="dark"`), `localStorage['flux.appearance']`.
- **Known gap:** different localStorage keys — they don't sync.

---

## 9. Rules (enforced)

1. Colour and font only through tokens (add dark counterpart before using).
2. One tile = one job = one colour.
3. Max six tiles per view.
4. Pastel on tiles; panels, tables, forms stay on `--surface`.
5. Animate only `transform`, `opacity`, `background-color`, `box-shadow`.
6. Honour `prefers-reduced-motion`; `overflow-x: clip` on `html`/`body`.
7. No uppercase/tracked labels, no emoji, no gradients, no glow, no card-in-card.

---

## 10. Files (this redesign)

| File | What |
|---|---|
| `public/css/theme.css` | The whole Stack-A design system (tokens, tiles, shell, components, dark mode, states) |
| `layouts/template.blade.php` | New shell (`.side` + `.main`, no top bar, pill nav) |
| `home.blade.php` | Bento grid dashboard |
| `forms.blade.php` + 5 index views | `.hero` + `.tbl` migrated |
| 15 create/edit/show views + 4 students views | `.hero` + ghost Back button migrated |
| `resources/css/app.css` | pastel tokens + radius scale (Flux) |
| `layouts/auth/split.blade.php`, `layouts/app/sidebar.blade.php` | indigo accent + full nav |

**Untouched:** `public/admin/` (vendored — do **not** edit), `dashboard.blade.php` (placeholder), settings/auth page bodies.

---

## 11. How to extend

1. **New tile:** pick one palette pair, add `.tile.<colour>`, give it a title, one-line sub, and a big number / chips / list.
2. **New admin page:** extend `layouts.template`, use `.hero` + tiles for summaries, `.panel` + `.tbl` for data.
3. **New colour:** add token (with dark value) to `theme.css` first, then use it.
4. **Rebuild:** `theme.css` is static (no build). `resources/css/app.css` changes need `npm run build`.
