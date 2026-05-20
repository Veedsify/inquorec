# Inquorec Product Specification

## Overview

Inquorec is an AI-assisted financial document platform for creating invoices, quotations, and receipts. It is designed for freelancers, small agencies, consultants, vendors, and service businesses that need professional documents without a heavy accounting system.

## Positioning

Inquorec is not full accounting software at MVP stage. It is a fast, beautiful, reliable document creation system for money-related business documents.

## Target Users

- Freelancers
- Web developers and agencies
- Consultants
- SMEs
- Service providers
- Vendors who issue receipts and quotations regularly

## Core Jobs To Be Done

1. Create professional documents quickly.
2. Reuse client, service, and bank information.
3. Calculate totals accurately.
4. Export clean PDFs.
5. Use AI to turn rough instructions into structured document content.

## Primary Modules

### Dashboard

- Revenue summary
- Draft documents
- Recent invoices, quotations, and receipts
- Outstanding invoices
- Quick actions

### Business Profile

- Business name
- Logo
- Address
- Contact email and phone
- Website
- Tax identification fields
- Default currency
- Brand colors

### Bank Accounts

- Bank name
- Account name
- Account number
- Currency
- Swift/IBAN fields, optional
- Default account selection

### Clients

- Individual or company client
- Name/company name
- Email
- Phone
- Address
- Notes
- Document history

### Service Catalog

- Service/item name
- Description
- Unit price
- Default tax rate
- Category
- Active/inactive status

### Documents

Supported MVP types:

- Invoice
- Quotation
- Receipt

Planned types:

- Proforma invoice
- Delivery note
- Client statement

### Document Builder

The document builder should include:

- Document type selector
- Client selector
- Issue date
- Due date, where applicable
- Line item table
- Discount controls
- Tax controls
- Notes
- Terms
- Bank account selector
- Template selector
- Preview panel

### Templates

MVP template styles:

1. Clean corporate
2. Modern freelancer
3. Premium agency

Templates should only control presentation. They should not contain calculation logic.

### AI Assistant

AI should be useful in structured moments:

- Generate line items from rough text
- Rewrite notes professionally
- Suggest quotation breakdowns
- Generate service descriptions
- Convert quotation to invoice
- Suggest payment terms

Every AI result must be editable before saving.

## MVP Success Criteria

The first working version is successful when a user can:

1. Register and create a business profile.
2. Add a client.
3. Add bank details.
4. Create an invoice with line items.
5. See correct totals.
6. Export a clean PDF.
7. Create a quotation.
8. Convert a quotation into an invoice.
9. Create a receipt for a paid invoice or standalone payment.

## Non-Goals For MVP

- Full double-entry accounting
- Payroll
- Inventory management
- Tax filing automation
- Complex multi-branch approvals
- Payment gateway integration
- Native mobile apps

## Product Risks

- Becoming too broad too early
- AI features feeling gimmicky
- PDF templates becoming hard to maintain
- Calculation mismatch between frontend and backend
- Weak document numbering rules

## Product Rules

- Backend is the source of truth for calculations.
- Document totals are saved as snapshots.
- Old documents must not change when service prices change.
- Documents should have lifecycle states.
- User must review AI output before it is saved.
