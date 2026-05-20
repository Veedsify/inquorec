# Inquorec MVP Roadmap

## Milestone 0: Project Setup

Goal: Prepare the application foundation.

Tasks:

- Scaffold Laravel 13 application
- Install Inertia React stack
- Configure TypeScript, Tailwind, and linting
- Configure database
- Add environment example
- Add authentication
- Add base dashboard layout

Acceptance Criteria:

- App runs locally
- User can register and log in
- Authenticated dashboard loads

## Milestone 1: Business Profile And Bank Details

Goal: Allow users to configure their business identity.

Tasks:

- Create businesses table/model
- Create bank_accounts table/model
- Build business profile settings page
- Build bank account CRUD
- Support default bank account

Acceptance Criteria:

- User can create/update business profile
- User can add multiple bank accounts
- User can mark one bank account as default

## Milestone 2: Clients And Services

Goal: Allow reusable business data.

Tasks:

- Create clients table/model
- Create service_items table/model
- Build client CRUD
- Build service item CRUD
- Add search/select components for clients and services

Acceptance Criteria:

- User can manage clients
- User can manage reusable services
- User can quickly select clients and services during document creation

## Milestone 3: Document Builder

Goal: Create invoices, quotations, and receipts.

Tasks:

- Create documents table/model
- Create document_items table/model
- Create document number generator
- Create document calculator service
- Build React document builder
- Add line item table
- Add totals preview
- Add backend validation and recalculation

Acceptance Criteria:

- User can create invoice, quotation, and receipt drafts
- User can add/edit/reorder line items
- Backend recalculates totals correctly
- Documents persist with stable totals

## Milestone 4: Templates And PDF Export

Goal: Export documents professionally.

Tasks:

- Create templates table/model
- Add system templates
- Build document preview page
- Add PDF export service
- Store exported PDFs if needed

Acceptance Criteria:

- User can preview a document
- User can choose a template
- User can export a clean PDF

## Milestone 5: AI Assistant

Goal: Reduce document creation friction with AI.

Tasks:

- Create ai_generations table/model
- Add AI provider configuration
- Build rough text to line items endpoint
- Build notes/terms improvement endpoint
- Add frontend AI assist panel
- Validate AI JSON output before showing it

Acceptance Criteria:

- User can generate draft line items from rough text
- User can rewrite notes and terms
- User reviews AI output before applying it
- AI generations are logged

## Milestone 6: Quote To Invoice And Receipt Flow

Goal: Support real business lifecycle.

Tasks:

- Add quotation acceptance state
- Add quote-to-invoice conversion
- Add invoice payment fields
- Add receipt creation from invoice
- Add standalone receipt creation

Acceptance Criteria:

- User can convert quotation into invoice
- User can mark invoice as paid/partially paid
- User can generate a receipt from payment data

## Milestone 7: Polish And Launch Prep

Goal: Make MVP usable and presentable.

Tasks:

- Improve dashboard summaries
- Add empty states
- Add document filters
- Add settings polish
- Add error handling
- Add basic tests for calculator and document creation
- Add deployment notes

Acceptance Criteria:

- MVP feels coherent
- Critical flows are tested
- App is ready for private beta users

## Recommended Build Order

1. Auth and dashboard
2. Business profile
3. Bank details
4. Clients
5. Services
6. Document models and calculator
7. Document builder UI
8. PDF export
9. AI assistant
10. Quote/invoice/receipt lifecycle

## Private Beta Goal

Invite 5 to 10 freelancers or small business owners to create real invoices and quotations. Watch where they hesitate. The best product decisions will come from those awkward moments.
