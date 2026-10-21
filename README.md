# Car Rental System

## CI2214 - Web Development 1

Web Development Assignment: Car Rental System

### Supervisor

Dr Saiful Omar

## Group Members

| Student Name | Enrollment Number |
|-------------|------------------|
| Akmal Arif bin Haji Zulkifli | B20250308 |
| Mohammad Akmal Khalaf @ Bazil Asna bin Haji Ariffin | B20250310 |
| Muhammad Nu'man Hani bin Hussin | B20250017 |

### Submission Information

- Submission Date: 21 October 2026
- Semester: 3
- Academic Session: July - December 2026

---

# 1. Website Purpose and Main Functions

## 1.1 Background and Problem Statement

Cars or any types of motorised vehicles are necessary to commute between two places in any unwalkable cities or nations. In Brunei Darussalam, car rentals are common especially for tourists visiting the nation.

The proposed car rental website provides a single website for the core operations and demonstrates a database-backed web application.

A basic workflow of the car rental website requires accurate vehicle information, clearly stated daily rates, valid pickup and return dates, and accessible booking records. If these processes are handled inconsistently or manually, it may take much more effort to maintain the website.

Hence, this project addresses the learning-level version of the problem with a searchable catalogue and booking management interface.

## 1.2 Aim and Objectives

### Project Aim

The aim of this project is to design and implement a responsive website that supports the base of the car rental workflow.

### Project Objectives

The objectives of this project are to:

1. Display cars by manufacturer, price, seats, transmission, fuel type, and description.
2. Allow customers to request rentals using pickup and return dates.
3. Provide admin vehicle CRUD, booking status management, customer records, and reports.
4. Store records in related database tables.
5. Apply basic validation, password hashing, prepared SQL statements, and sessions.

---

# 1.3 Project Scope

## 1.3.1 System Boundaries

The boundaries of the system define the main functions and information that are included and excluded from the project.

### Within the System Boundary

- Home page and featured cars.
- Booking request creation, date validation, overlap checks, booking history, and pending cancellation.
- Admin dashboard, vehicle management, booking status updates, customer listing, and basic reports.
- Responsive layout, JavaScript enhancements, SQL schema, and sample vehicle data.

### Outside the System Boundary

- Online payment gateway, deposits, refunds, and invoices.
- Email/SMS notifications and password reset.
- Driving licence verification or document uploads.
- Vehicle handover, return inspection, damage reporting, and maintenance scheduling.
- Reviews, loyalty programmes, multi-branch inventory, and automated accounting exports.
- Production deployment, monitoring, and comprehensive audit logging.

The site records booking requests and statuses, but it does not process payments or manage the complete real-world rental operation.

---

# 2. Setup Instructions

Before setting up the website, several tools may be needed to run the website.

## Required Software

- XAMPP
- MySQL Workbench
- GitHub

## 2.1 Database Setup

1. Download the project files from GitHub:

   ```
   https://github.com/ksjdjjd234/CI2214-WebDevelopment1
   ```

2. Extract the contents into:

   ```
   C:\xampp\htdocs
   ```

3. Start MySQL from the XAMPP Control Panel.

4. Open MySQL Workbench and import the SQL file.

---

## 2.2 Website Setup

### 2.2.1 Setting Up Locally

1. Download the project files from GitHub:

   ```
   https://github.com/ksjdjjd234/CI2214-WebDevelopment1
   ```

2. Extract the contents into:

   ```
   C:\xampp\htdocs
   ```

3. Open XAMPP Control Panel and start:
   - Apache
   - MySQL

4. Open the website in a browser:

   ```
   http://localhost/index.php
   ```

### 2.2.2 Published Website

The published website is available at:

```
https://webdevgroup12.infinityfree.io/index.php
```

---

## 2.3 Admin Features

Use the following credentials to access the admin portal:

**Username**

```text
admin
```

**Password**

```text
sandihmeth
```

---

# 3. Key Challenges

## 1. Car Specifications

Collecting real data from each car manufacturer requires significant time and effort. This process may include:

- Collecting brochures
- Consulting sales representatives
- Manually researching vehicle specifications online

Therefore, dummy data were used as a substitute for real vehicle data.

## 2. Team Collaboration and Task Distribution

As this was a group project, coordinating and distributing tasks among team members was one of the major challenges.

The work was divided into three main areas:

- Frontend Development
- Backend Development
- Testing and Documentation

The challenges faced during development highlighted the importance of the System Development Life Cycle (SDLC) and effective teamwork.

The proposed solutions helped organize the system into manageable modules and establish a foundation for a more reliable and user-friendly car rental website.

---

# 4. Group Member Contributions

| Member | Responsibilities |
|----------|------------------|
| Akmal Arif bin Haji Zulkifli | Backend Development (PHP and Database) |
| Mohammad Akmal Khalaf @ Bazil Asna bin Haji Ariffin | Frontend Development (HTML, CSS and JavaScript) |
| Muhammad Nu'man Hani bin Hussin | Testing and Documentation |

---

# Technologies Used

- PHP
- HTML
- CSS
- JavaScript
- MySQL
- MySQL Workbench
- XAMPP
- GitHub
- InfinityFree

---

# Features

- Car Listing System
- Car Booking System
- Admin Login System
- Dashboard Statistics
- User Management
- Vehicle Management
- Booking Management
- Database Integration
- Session-Based Authentication
