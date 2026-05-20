# Inquorec Database Design

## Design Philosophy

Inquorec should store financial documents as stable snapshots. If a user changes a service price tomorrow, yesterday's invoice must remain unchanged.

Money calculations should be validated and persisted by the backend.

## Main Entities

### users

Laravel default users table.

Suggested additions later:

- name
- email
- password
- timezone
- preferred_currency

### businesses

Represents a user's business/workspace.

Fields:

- id
- user_id
- name
- legal_name
- email
- phone
- website
- address_line_1
- address_line_2
- city
- state
- country
- postal_code
- logo_path
- tax_identifier
- default_currency
- brand_color
- created_at
- updated_at

### bank_accounts

Fields:

- id
- business_id
- bank_name
- account_name
- account_number
- currency
- swift_code
- iban
- routing_number
- is_default
- created_at
- updated_at

### clients

Fields:

- id
- business_id
- type: individual/company
- name
- company_name
- email
- phone
- address_line_1
- address_line_2
- city
- state
- country
- postal_code
- notes
- created_at
- updated_at

### service_items

Reusable services/products users can insert into documents.

Fields:

- id
- business_id
- name
- description
- unit_price
- currency
- default_tax_rate
- category
- is_active
- created_at
- updated_at

### documents

Central table for invoices, quotations, and receipts.

Fields:

- id
- business_id
- client_id
- bank_account_id
- template_id
- type: invoice/quotation/receipt/proforma/delivery_note/statement
- status: draft/sent/viewed/accepted/paid/cancelled/expired
- document_number
- reference
- issue_date
- due_date
- currency
- subtotal
- tax_total
- discount_total
- grand_total
- amount_paid
- balance_due
- notes
- terms
- footer
- metadata json
- sent_at
- accepted_at
- paid_at
- cancelled_at
- created_at
- updated_at

Important:

- `subtotal`, `tax_total`, `discount_total`, and `grand_total` should be stored as integers in minor currency units where possible.
- For NGN, this can mean kobo if precision is required, or whole naira if the product intentionally avoids kobo.

### document_items

Fields:

- id
- document_id
- service_item_id nullable
- name
- description
- quantity
- unit_price
- discount_type: fixed/percentage/none
- discount_value
- tax_rate
- subtotal
- discount_total
- tax_total
- line_total
- sort_order
- metadata json
- created_at
- updated_at

### templates

Fields:

- id
- business_id nullable
- name
- slug
- type
- preview_image_path
- config json
- is_system
- is_active
- created_at
- updated_at

### ai_generations

Stores AI requests and results for audit/debugging.

Fields:

- id
- business_id
- user_id
- document_id nullable
- feature: line_items/notes/terms/service_description/quote_to_invoice
- input_text
- output_json
- model
- status: pending/completed/failed
- error_message
- tokens_input
- tokens_output
- created_at
- updated_at

## Suggested Relationships

- User has many businesses
- Business has many clients
- Business has many bank accounts
- Business has many service items
- Business has many documents
- Document belongs to client
- Document belongs to bank account
- Document has many document items
- Document belongs to template
- Document has many AI generations

## Calculation Rules

For each document item:

1. base = quantity * unit_price
2. discount = fixed amount or percentage of base
3. taxable_amount = base - discount
4. tax = taxable_amount * tax_rate
5. line_total = taxable_amount + tax

For the document:

1. subtotal = sum item base totals
2. discount_total = sum item discounts plus document-level discount, if introduced
3. tax_total = sum item taxes
4. grand_total = sum line totals
5. balance_due = grand_total - amount_paid

## Recommended Indexes

- businesses.user_id
- clients.business_id
- bank_accounts.business_id
- service_items.business_id
- documents.business_id
- documents.client_id
- documents.type
- documents.status
- documents.document_number
- document_items.document_id
- ai_generations.business_id
- ai_generations.document_id

## Future Extensions

- recurring_documents
- payments
- document_activity_logs
- document_shares
- document_attachments
- client_portal_tokens
- webhook_events
