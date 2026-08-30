# 📋 Editing v2

**EduALL's essay editing & management platform** — a Laravel web application that powers the full lifecycle of college essay editing. Clients upload essays, admins assign editors, editors work on the submissions, managing editors verify quality, and mentors stay informed — with status tracking, automated notifications, and reporting throughout.

---

## 🎯 Goal

Provide a centralized, structured workflow for EduALL's essay editing service so every essay moves smoothly from submission to completion — with clearly defined roles (**Admin, Editor, Managing Editor, Mentor**), full status tracking, automated reminders, and transparent reporting.

---

## ⭐ Key Features

### 👥 Role-Based Access
- Separate logins, dashboards, and workflows for **Admin**, **Editor**, **Managing Editor**, and **Mentor**
- Session-based multi-guard authentication + token-based API access via **Laravel Sanctum**
- Dedicated forgot-password & reset-password flows per role

### 📝 Essay Management & Workflow
- Client essay submission with file uploads
- Admin / Managing Editor assignment of **editors** and **mentors** per essay
- Editor **accept / reject**, add comments, and upload finished or revised files
- Managing Editor **verify**, **request revision**, **send to mentor**, and **cancel revision** actions
- Full essay status-history tracking (`tbl_essay_status`)
- Essay prompts database, editing **programs**, **universities**, and **categories & tags** management

### 👤 Client & Mentor Management
- Client (student) list with pagination, search, and detailed views
- Assign primary and **backup mentors** per student
- Mentor dashboards for mentees, essay lists, and new essay requests
- Student status updates via API

### 🔔 Notifications & Reminders
- **Email notifications** for assignment, cancellation, completion, revision, editor invite, new requests, and per-editor updates
- **Real-time events** broadcast via **Pusher** (editor / managing / mentor channels)
- Scheduled reminder commands (`check:reminder_editor`, `check:reminder_managing`) that email pending essays

### 📊 Reporting & Data Export
- DataTables-powered lists for ongoing, completed, and **due-essay views** (tomorrow / within 3 / within 5 days)
- Report list and editor performance view
- **Excel export** filtered by month, year, editor, essay type, and status — including work duration, ratings, and clickable file links
- Editor **work-duration tracking** per essay

### 🔗 CRM Integration
- One-click **sync of clients (mentees) and mentors** from the CRM (`https://crm-allinedu.com`)
- API endpoints for mentor/student essay lists and essay uploads

### 🛠️ Technical Highlights
- Laravel 8.x with PHP 7.2 – 8.0
- MySQL database (`utf8mb4`)
- Blade templates with Laravel Mix (Bootstrap) frontend
- Laravel Sanctum for API tokens
- Yajra DataTables & Maatwebsite Excel
- File uploads stored under `public/uploaded_files/program/essay/`

---

## 🔗 How It Works

```
Student essay submitted (tbl_essay_clients)
        │
        ▼
Admin / Managing Editor assigns an Editor (+ mentor)
        │
        ▼
Editor accepts or rejects the assignment
        │
        ▼
Editor uploads the edited essay & adds comments
        │
        ▼
Managing Editor verifies, requests revision,
or sends the essay to the mentor
        │
        ▼
Mentor reviews the essay & gives feedback
        │
        ▼
Essay marked complete — status history recorded
(tbl_essay_status, tbl_essay_feedback, tbl_work_duration)
```

### Core Modules Connection

| Module | Key Tables | Connects Via |
|--------|-----------|--------------|
| **Auth** | `tbl_admins`, `tbl_editors`, `tbl_mentors`, `users` | Multi-guard session + Sanctum |
| **Essays** | `tbl_essay_clients`, `tbl_essay_editors`, `tbl_essay_status` | `id_essay_clients` |
| **Quality / Feedback** | `tbl_essay_feedback`, `tbl_essay_revise`, `tbl_essay_reject` | `id_essay_clients` |
| **Configuration** | `tbl_programs`, `tbl_universities`, `tbl_categories`, `tbl_tags` | `id_program`, `id_univ`, `id_topic` |
| **Tracking** | `tbl_work_duration`, `tbl_managing_feedback` | `id_essay_editors` |
| **Clients** | `tbl_clients`, `tbl_mentors` | `id_mentor` |

---

## 🏆 Key Benefits

| Benefit | Description |
|---------|-------------|
| **Clear Roles** | Each actor gets a dedicated dashboard and scope of work |
| **End-to-End Tracking** | Every essay status change is recorded in history |
| **Quality Control** | Managing editors verify or request revision before completion |
| **Automated Reminders** | Scheduled emails keep pending essays moving |
| **Data-Driven Reports** | Filterable Excel exports with ratings and work duration |
| **CRM Integration** | Clients and mentors synced directly from the CRM |
| **Real-Time Alerts** | Pusher events notify the right people instantly |

---

## 📚 Documentation

| Document | Path | Description |
|----------|------|-------------|
| Database Schema | `docs/DATABASE_SCHEMA.md` | Full table definitions, relations, and business concepts |
| DBML Diagram | `docs/editing_v2_schema.dbml` | Editable database diagram |
| ERD View | `docs/editing_dbdiagram.pdf` | Visual entity-relationship diagram |
| API Routes | `routes/api.php` | Mentor / student API endpoints |
| Web Routes | `routes/web/` | Admin, editor, managing-editor, and mentor routes |

---

## 📌 Project Information

| Field | Value |
|-------|-------|
| **Version** | v2 (editing-v2) |
| **Platform** | Web application |
| **Framework** | Laravel 8.x (`v8.83.27`) |
| **PHP Version** | 7.2 – 8.0 |
| **Database** | MySQL (`utf8mb4`) |
| **Auth** | Multi-guard session + Laravel Sanctum |
| **Frontend** | Blade + Laravel Mix (Bootstrap) |
| **Real-time** | Pusher + Laravel events |
| **CRM Integration** | `https://crm-allinedu.com` |
| **Last Updated** | November 2024 |