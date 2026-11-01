# ITT626 — BackEnd Lab · Timetable App

A timetable management system built with Laravel.

**Lecturer:** Sir Asrol

## About

Timetable management app for subjects, lecture halls, groups, days and timetable slots.
Built on top of the Laravel Livewire Starter Kit.

## Tech stack

- Laravel 13 (PHP ^8.3)
- Livewire 4 · Flux 2 · Tailwind CSS v4
- Fortify (authentication)
- MySQL

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Run

```bash
composer run dev
```

## Design

- `DESIGN-SYSTEM.md` — design system & page structure (Bento Pastel)
- `public/css/theme.css` — admin design tokens & components
