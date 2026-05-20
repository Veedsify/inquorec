# Inquorec

AI-powered invoices, quotations, and receipts for modern service businesses.

Inquorec is a document automation platform for freelancers, agencies, consultants, SMEs, and service providers who need to create polished financial documents quickly. It helps users create invoices, quotations, and receipts with reusable services, self-calculating document tables, bank details, templates, PDF export, and AI-assisted document drafting.

## Product Vision

Most small businesses do not need a heavy accounting suite on day one. They need fast, beautiful, accurate documents they can send to clients without fighting spreadsheets, Word files, or copied invoice templates.

Inquorec focuses on one core promise:

> Create professional invoices, quotations, and receipts in minutes, then export or send them confidently.

## Core Document Types

- Quotations
- Invoices
- Receipts
- Proforma invoices, planned
- Client statements, planned
- Delivery notes, planned

## MVP Features

### Workspace and Business Profile

- User account and workspace setup
- Business name, logo, contact details, address, tax fields, and branding
- Multiple bank accounts per business

### Clients

- Client records with name, email, phone, address, and company details
- Client document history
- Quick client creation while building a document

### Services and Items

- Reusable service/item catalog
- Name, description, unit price, tax setting, and category
- Fast insertion into document line items

### Document Builder

- Create quotations, invoices, and receipts
- Self-calculating line item table
- Quantity, unit price, discount, tax, subtotal, and grand total
- Document notes and terms
- Bank details selection
- Draft, sent, paid, cancelled, and expired states where applicable

### Templates and Export

- Multiple visual templates
- Template preview
- PDF export
- Print-friendly layout

### AI Assistant

- Convert rough instructions into line items
- Improve document notes and payment terms
- Suggest service breakdowns for quotations
- Generate professional descriptions for services
- Convert quotations into invoices with sensible defaults

## Proposed Stack

- Backend: Laravel 13
- Frontend bridge: Inertia.js
- Frontend: React + TypeScript
- Styling: Tailwind CSS
- Database: PostgreSQL or MySQL
- PDF rendering: Browsershot, DomPDF, or server-side HTML-to-PDF strategy
- Queue: Laravel Queues for AI generation and PDF processing
- Storage: Local/S3-compatible storage for logos and exported PDFs

## Recommended Local Setup

```bash
composer create-project laravel/laravel inquorec
cd inquorec

composer require laravel/breeze --dev
php artisan breeze:install react

npm install
npm run dev
php artisan migrate
```

After scaffolding Laravel locally, commit and push the generated app into this repository.

```bash
git init
git add .
git commit -m "Initial Laravel Inertia React setup"
git branch -M main
git remote add origin git@github.com:Veedsify/inquorec.git
git push -u origin main
```

## Development Principles

- Backend is the source of truth for money calculations.
- React can preview totals, but Laravel must validate and recalculate before saving.
- Store document totals as snapshots so old invoices do not change when services/prices change later.
- Keep AI features assistive, not magical. The user should always review before saving or sending.
- Treat templates as presentation, not business logic.
- Keep document numbering predictable and configurable.

## Suggested First Milestone

Build a usable MVP where a user can:

1. Create a business profile.
2. Add bank details.
3. Add a client.
4. Add reusable services.
5. Create an invoice with line items.
6. See accurate calculated totals.
7. Export a clean PDF.
8. Create a quotation and convert it into an invoice.

## Repository Status

This repository is currently in the planning/scaffolding stage.

See the `/docs` directory for product planning, database design, and AI feature direction.
