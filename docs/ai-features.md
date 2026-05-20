# Inquorec AI Feature Plan

## AI Philosophy

AI in Inquorec should reduce friction, not replace user judgment.

The user must always review and approve AI-generated content before it becomes part of a saved financial document.

## Core AI Use Cases

### 1. Rough Text To Line Items

User input example:

> Create invoice for TMAG phase one: backend API setup, React dashboard, authentication, database migration, 435k kickoff.

Expected AI output:

```json
{
  "items": [
    {
      "name": "Backend API Setup",
      "description": "Initial Laravel/Spring-style backend API setup for phase one delivery.",
      "quantity": 1,
      "unit_price": 150000
    },
    {
      "name": "React Dashboard Setup",
      "description": "Frontend dashboard structure and core interface setup.",
      "quantity": 1,
      "unit_price": 135000
    },
    {
      "name": "Authentication & Database Migration",
      "description": "Authentication flow setup and database migration structure.",
      "quantity": 1,
      "unit_price": 150000
    }
  ],
  "notes": "Thank you for your business.",
  "terms": "Payment is due according to the agreed project milestone."
}
```

### 2. Notes Improvement

Input:

> pay before friday abeg

Output:

> Kindly complete payment on or before Friday to allow work to continue according to the agreed delivery schedule.

### 3. Quotation Breakdown Generator

User gives a broad service request. AI suggests structured phases/items.

Example:

> Build a website for a travel agency with admin dashboard and blog.

Output should include line items like:

- Discovery and content structure
- Website UI development
- Admin dashboard
- Blog/content management
- Deployment and handover

### 4. Service Description Generator

AI helps turn short service names into professional descriptions.

Input:

> Website maintenance

Output:

> Monthly website maintenance covering content updates, bug fixes, performance checks, backups, and minor interface adjustments.

### 5. Quote To Invoice Conversion Assistant

AI can suggest invoice language when converting an accepted quotation to an invoice.

The actual item copying should be deterministic backend logic, not AI.

### 6. Payment Terms Generator

AI can generate polite terms based on context:

- Immediate payment
- 50% upfront, 50% on completion
- Net 7
- Net 14
- Milestone-based payment

## Safety Rules

- AI must not silently change totals.
- AI must not mark documents as paid.
- AI must not send documents automatically.
- AI must not invent bank details.
- AI must not override user-entered prices without confirmation.
- AI output must be editable before saving.

## Suggested Backend Structure

```txt
app/Services/Ai/
  AiDocumentParser.php
  AiLineItemGenerator.php
  AiNotesRewriter.php
  AiTermsGenerator.php
  AiServiceDescriptionGenerator.php
```

## Suggested Request Flow

1. User enters rough text.
2. Backend validates request.
3. AI service sends structured prompt.
4. AI returns JSON.
5. Backend validates JSON schema.
6. Frontend displays result for review.
7. User accepts, edits, or discards.

## Suggested AI Response Shape

```json
{
  "items": [
    {
      "name": "string",
      "description": "string",
      "quantity": 1,
      "unit_price": 0,
      "tax_rate": 0
    }
  ],
  "notes": "string",
  "terms": "string",
  "warnings": []
}
```

## Prompting Guidelines

The AI should be instructed to:

- Return valid JSON only.
- Never calculate hidden charges.
- Preserve user-specified prices.
- Ask for missing information through warnings, not hallucinated values.
- Keep descriptions professional and concise.
- Use the user's selected currency.

## Future AI Ideas

- Detect unpaid invoices and suggest polite reminders.
- Generate client-specific proposal letters.
- Summarize monthly document activity.
- Suggest pricing based on previous services.
- Create a template from an uploaded document.
- Extract invoice data from uploaded PDFs/images.
