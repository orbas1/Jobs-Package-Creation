# Agent Instructions – Jobs Package (Laravel + Flutter)

## Overall Goal

Your goal is to create:

1. A **Laravel package** (`jobs_laravel_package`), and  
2. A **Flutter mobile addon package** (`jobs_flutter_addon`),

that together provide the **same jobs functionality** on both:

- The **Laravel backend / web app**, and  
- The **Flutter mobile app**.

These will plug into an existing **social media style platform**, moving it towards a **LinkedIn-style professional network**.

> ⚠️ Important: **Do not copy any binary files** (e.g. images, fonts, compiled assets, `.exe`, `.dll`, `.so`, etc.).

---

## Source Applications

- Backend source: `jobi` (Laravel jobs platform)  
- Mobile source: existing `jobi` mobile app (if present) or any React/React Native jobs client in this codebase

We will **copy the necessary logic and structure** from these into:

- `jobs_laravel_package` (Laravel package)  
- `jobs_flutter_addon` (Flutter addon package)

The aim is **full feature parity** with the original `jobi` jobs functionality.

---

## Part 1 – Laravel Jobs Package (`jobs_laravel_package`)

We are building a **proper Laravel package** (installable via Composer, likely using a `path` repository). This package will be added into the main social app and must include all files required for **full jobs functionality**.

When extracting from `jobi`, ensure the following areas are copied/refactored into the package:

1. **Config**
   - Package config files (e.g. `config/jobs.php`).
   - Settings for:
     - Job posting limits
     - Subscription plans / job posting fees
     - Roles and permissions (job seeker / employer / recruiter)
     - Feature toggles (ATS on/off, CV builder on/off, etc.).

2. **Database**
   - All required **migrations**, including tables for:
     - Job seekers and employer/company profiles
     - Job postings
     - Job applications
     - ATS-related entities (statuses, stages, pipelines)
     - CV templates / saved CVs
     - Cover letters
     - Screening questions and answers
     - Subscription plans, job posting credits, and payment records
     - Interview schedules and interview invitations
   - Any **seeders** necessary for:
     - Default job categories
     - Default ATS stages
     - Default subscription/job posting plans.

3. **Domains**
   - Domain logic organised by feature area, for example:
     - `Domain/UserUpgrade`  
       - Enabling job seeker and employer/company capabilities
     - `Domain/Jobs`  
       - Job posting, editing, publishing, expiring
     - `Domain/ATS`  
       - Candidate pipeline, statuses, notes, stages
     - `Domain/CV`  
       - CV creation, storage, templates
     - `Domain/Applications`  
       - Job applications, statuses, messaging hooks
     - `Domain/CoverLetters`  
       - Cover letter creation and storage
     - `Domain/Screening`  
       - Pre-job application screening questions and answers
     - `Domain/Subscriptions`  
       - Subscription/job posting fees, plan logic
     - `Domain/Interviews`  
       - Interview schedule, invitations, links, and viewing
   - Keep domain logic cohesive and separated into appropriate namespaces.

4. **Http**
   - Controllers (web + API) for:
     - Job listings and details
     - Job posting/management
     - Applications
     - ATS operations (moving candidates through stages)
     - CV and cover letter creation/editing
     - Screening question configuration and responses
     - Subscription/payment endpoints
     - Interview scheduling/invites
   - Form requests / validation classes.
   - Middleware specific to jobs operations (if any), e.g. “must be employer to post job”.

5. **Policies**
   - Authorization policies for:
     - Managing jobs (only owner/employer or admins)
     - Viewing/managing applications
     - Editing company profiles
     - Accessing ATS pipelines and interview details.

6. **Resources**
   - Blade templates for jobs-related UI.
   - Language files.
   - Any asset stubs that need to be published from the package.

7. **Admin Panel Entries**
   - Admin menus and configuration for:
     - Global job categories and locations
     - Job postings moderation
     - Application statistics overview
     - Subscription plans / job posting fees management
   - Any admin controllers, views, and routes required to manage jobs data from the admin panel.

8. **Frontend Views**
   - User-facing views for:
     - Browsing/searching jobs
     - Viewing job details
     - Creating and editing job postings
     - Managing company/employer profiles
     - Managing applications (for both job seekers and employers)
     - CV builder and cover letter editor
     - Interview schedule and invitations.

9. **Assets**
   - Any **non-binary** assets required (CSS, SCSS, SVG where applicable).
   - Frontend resources that support the jobs UI.

10. **Language Translations**
    - Language files used by the jobs module (e.g. `resources/lang/en/jobs.php`).
    - Ensure all user-facing jobs text strings are covered.

11. **JavaScript**
    - Any JS needed for interactive features such as:
      - Job filters, search, live updates
      - ATS drag-and-drop stages (if present)
      - CV/cover letter editor interactions
    - Extract and adapt JS from `jobi` where relevant.

12. **Routes**
    - Web routes for:
      - Jobs listing and management pages
      - Company profile management
      - Applications and ATS screens
    - API routes for:
      - Jobs listing/search
      - Posting/editing jobs
      - Managing applications
      - ATS actions
      - CV/cover letter operations
      - Interview scheduling/invites
    - These API routes will be consumed by the Flutter addon.

13. **Services**
    - Service classes for:
      - Job search and filtering
      - ATS transitions and rules
      - CV and cover letter generation/saving
      - Screening question handling
