1.0	Website purpose and main functions
1.1	Background and Problem Statement
Cars or any types of motorised vehicles are necessary to commute between two places in any unwalkable cities or nations. In Brunei Darussalam, car rentals are common especially for tourists visiting the nation. The proposed car rental website provides a single website for the core operations and demonstrates a database-backed web application.

A basic workflow of the car rental website requires accurate vehicle information, clearly stated daily rates, valid pickup and return dates, and accessible booking records. If these processes are handled inconsistently or manually, it may take much more to maintain the website.

Hence, this project addresses the learning level version of the problem with a searchable catalogue and booking management interface.

1.2	Aim and Objectives
1.2.1	Project Aim
The aim of this project is to design and implement a responsive website that supports the base of the car rental workflow.


1.2.2	Project Objectives
The objectives of this project are to:
Display cars by manufacturer, price, seats, transmission, fuel type, and description.
Allow customers to request rentals using pickup and return dates.
Provide admin vehicle CRUD, booking status management, customer records, and reports.
Store records in related database tables.
Apply basic validation, password hashing, prepared SQL statements, sessions.

1.3	Project Scope
1.3.1	System Boundaries
The boundaries of the system define the main functions and information that are included and excluded from the project.

1.3.1.1	Within the system boundary
Home page and featured cars.
Booking request creation, date validation, overlap checks, booking history, and pending cancellation.
Admin dashboard, vehicle management, booking status updates, customer listing, and basic reports.
Responsive layout, JavaScript enhancements, SQL schema, and sample vehicle data.


1.3.1.2	Outside the system boundary
Online payment gateway, deposits, refunds, and invoices.
Email/SMS notifications and password reset.
Driving-licence verification or document uploads.
Vehicle handover, return inspection, damage reporting, and maintenance scheduling.
Reviews, loyalty programmes, multi-branch inventory, and automated accounting exports.
Production deployment, monitoring, and comprehensive audit logging.


The site records booking requests and statuses, but it does not process payments or manage the complete real-world rental operation.


2.0	Setup instructions
Before setting up the website, several tools may be needed to open the website. The common tools needed are XAMPP, MYSQL Workbench, and github.
2.1	Database Setup
Download the .zip files from github (https://github.com/ksjdjjd234/CI2214-WebDevelopment1).
Extract the contents of the files in C:\xampp\htdocs folder.
Open XAMPP Control Panel start MySQL.
Open MYSQL Workbench and import the SQL file.

2.2	Website Setup
2.2.1	Setting up locally
Download the .zip files from github (https://github.com/ksjdjjd234/CI2214-WebDevelopment1).
Extract the contents of the files in C:\xampp\htdocs folder.
Open XAMPP Control Panel, start Apache and MySQL.
Go to (http://localhost/index.php) or any similar directory (depending where the extracted files are kept).

2.2.2	Published website
The published website is available at (https://webdevgroup12.infinityfree.io/index.php)

2.3	Admin Features
To access admin features, use the following informations:
Username: admin
Password: sandihmeth

3.0	Key challenges
Car specifications
Collecting real data from each car manufacturer requires time to gather the information needed for the website. This process may include extracting data from collecting car brochures, inquiring sales agents from various different car manufacturers, and manually searching for the car specifications from online websites. Therefore, dummy data were used as a substitute for the real data.

Team collaboration and task distribution
As this was a group project, coordinating and distributing different tasks for the website development was one of the major challenges. Therefore, the work was divided into three areas: frontend, backend, testing and documentation.

The challenges faced during the development of the car rental website highlighted the importance of the system development lifecycle (SDLC) and effective teamwork. The proposed solutions helped organise the system into manageable modules and establish a foundation for a more reliable and user friendly car rental website. The effectiveness of these solutions should be confirmed through actual system testing before the final project submission.


4.0	Group Member Contributions


Member
Responsibilities
Akmal Arif bin Haji Zulkifli
Backend development (PHP and Database)
Mohammad Akmal Khalaf @ Bazil Asna bin Haji Ariffin
Frontend development (HTML, CSS and Javascript)
Muhammad Nu’man Hani bin Hussin
Testing and Documentation

