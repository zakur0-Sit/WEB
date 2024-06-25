## Software Requirements Specification

## For FoSA (Footwear Selection Application)

Version 1.0 approved Prepared by Cazacu Ion and Țigănescu Ioan Iustin Web Development Course, FII UAIC, Year 2 Date created: [25/06/2024]

---

### Table of Contents

- [Introduction](#1-introduction)
    - 1.1 [Purpose](#11-purpose)
    - 1.2 [Document Conventions](#12-document-conventions)
    - 1.3 [Intended Audience and Reading Suggestions](#13-intended-audience-and-reading-suggestions)
    - 1.4 [Product Scope](#14-product-scope)
    - 1.5 [References](#15-references)
- [Overall Description](#overall-description)
    - 2.1 [Product Perspective](#21-product-perspective)
    - 2.2 [Product Functions](#22-product-functions)
    - 2.3 [User Classes and Characteristics](#23-user-classes-and-characteristics)
    - 2.4 [Operating Environment](#24-operating-environment)
    - 2.5 [Design and Implementation Constraints](#25-design-and-implementation-constraints)
    - 2.6 [User Documentation](#26-user-documentation)
    - 2.7 [Assumptions and Dependencies](#27-assumptions-and-dependencies)
- [External Interface Requirements](#external-interface-requirements)
    - 3.1 [User Interfaces](#31-user-interfaces)
    - 3.2 [Hardware Interfaces](#32-hardware-interfaces)
    - 3.3 [Software Interfaces](#33-software-interfaces)
    - 3.4 [Communications Interfaces](#34-communications-interfaces)
- [System Features](#system-features)
    - 4.1 [Notifications and Alerts](#41-notifications-and-alerts)
    - 4.2 [User History and Account Management](#42-user-history-and-account-management)
    - 4.3 [Support and Assistance](#43-support-and-assistance)
- [Other Nonfunctional Requirements](#other-nonfunctional-requirements)
    - 5.1 [Performance Requirements](#51-performance-requirements)
    - 5.2 [Safety Requirements](#52-safety-requirements)
    - 5.3 [Security Requirements](#53-security-requirements)
    - 5.4 [Software Quality Attributes](#54-software-quality-attributes)
    - 5.5 [Business Rules](#55-business-rules)
- [Other Requirements](#other-requirements)
- [Appendix A: Glossary](#appendix-a-glossary)
- [Appendix B: Analysis Models](#appendix-b-analysis-models)

---

## 1. Introduction

### 1.1 Purpose

This document specifies the software requirements for the Footwear Selection Application (FoSA), developed for the Web Development Course at FII UAIC, Year 2. The application aims to help users choose appropriate footwear for various occasions by offering recommendations.

### 1.2 Document Conventions

This document follows the IEEE requirements specification format. Key points are highlighted using bold text, and sections are organized using headings and subheadings. Functional requirements are identified with unique tags for easy reference.

### 1.3 Intended Audience and Reading Suggestions

This document is intended for developers, users, testers, and documentation writers. It contains an overview of the project, detailed functional and non-functional requirements, and appendices with additional information. Readers are advised to start with the introduction and product scope, then proceed to sections relevant to their roles.

### 1.4 Product Scope

FoSA is a web application designed to assist users in selecting footwear for various occasions. It provides recommendations based on factors such as, color palette, brand, fashion trends, and personal style. The application allows users to save by liking and rate suggestions, receive purchase information.

### 1.5 References

1. Web Development Course, FII UAIC
2. HTML, CSS, JavaScript, and PHP documentation
3. Online fashion and footwear trend resources

---

## Overall Description

### 2.1 Product Perspective

FoSA is a standalone web application that does not depend on any existing systems. It is designed to provide a user-friendly interface for selecting and purchasing footwear. The application will share recommendations using email services.

### 2.2 Product Functions

- **Home Page**: Explore footwear based on the desired season.
- **Search Functionality**: Search for footwear by category, brand, size, color and price.
- **Product Recommendations**: Receive personalized suggestions by e-mail based on preferences.
- **Purchase Options**: Redirect users to purchase pages.
- **User Interaction**: Rate and like product suggestions.

### 2.3 User Classes and Characteristics

- **Readers**: Follow the latest fashion news.
- **Followers**: Receive personalized footwear suggestions.
- **Buyers**: Interested in purchasing footwear.

### 2.4 Operating Environment

FoSA is a responsive web application that works on any device, regardless of platform or operating system. The frontend and backend are developed using HTML, CSS, JavaScript, and PHP.

### 2.5 Design and Implementation Constraints

- **Regulatory Policies**: Compliance with data protection and privacy laws.
- **Hardware Limitations**: Ensure compatibility with various devices.
- **Security Considerations**: Implement robust security measures to protect user data.

### 2.6 User Documentation

- **About Page**: Information about the application and its offerings.
- **Help Page**: Tutorials and FAQs to assist users in navigating the application.

### 2.7 Assumptions and Dependencies

- Users have access to the internet.
- Data from external fashion websites is accessible and reliable.

---

## External Interface Requirements

### 3.1 User Interfaces

- **Homepage**: Seasonal footwear recommendations.
- **Product Page**: Filters for category, brand, size, color and price. Detailed product descriptions, ratings, and purchase options.
- **User Account Page**: Liked products history and account management.

### 3.2 Hardware Interfaces

- **Server**: Host the web application and database.
- **User Devices**: Access the application via web browsers on desktops, tablets, and smartphones.

### 3.3 Software Interfaces

- **Database**: Store user data, product information, and transaction history.
- **API**: Integrate with email services.

### 3.4 Communications Interfaces

- **HTTP/HTTPS**: Ensure secure data transmission between the client and server.
- **Email Notifications**: Send personalized footwear recommendations and alerts.

---

## System Features

### 4.1 Notifications and Alerts

#### 4.1.1 Description and Priority

Users can receive notifications about discounts, promotions, and new arrivals. This feature is of medium priority.

#### 4.1.2 Stimulus/Response Sequences

- **User Action**: Set an e-mail for notifications.
- **System Response**: Send notifications via email.

#### 4.1.3 Functional Requirements

- Provide an option for notifications.
- Send email notifications based on user preferences.

### 4.2 User History and Account Management

#### 4.2.1 Description and Priority

Users can manage account details, and save favorite items. This feature is of high priority for enhancing user experience.

#### 4.2.2 Stimulus/Response Sequences

- **User Action**: View account history.
- **System Response**: Display the user's saved items.

#### 4.2.3 Functional Requirements

- Allow users to update account details.
- Provide an option to save favorite items.

### 4.3 Support and Assistance

#### 4.3.1 Description and Priority

Provide users with support and assistance through a dedicated help page. This feature is of medium priority.

#### 4.3.2 Stimulus/Response Sequences

- **User Action**: Access the help page.
- **System Response**: Display FAQs and contact information.

#### 4.3.3 Functional Requirements

- Develop a comprehensive help page.
- Include FAQs and contact information for user support.

---

## Other Nonfunctional Requirements

### 5.1 Performance Requirements

The application should load within 3 seconds on standard internet connections and be able to handle up to 1000 concurrent users without performance degradation.

### 5.2 Safety Requirements

Implement data validation to prevent SQL injection, cross-site scripting (XSS), and other common security threats.

### 5.3 Security Requirements

Use HTTPS for secure data transmission and encrypt sensitive user data. Implement authentication and authorization mechanisms to protect user accounts.

### 5.4 Software Quality Attributes

- **Usability**: Ensure the application is easy to navigate and user-friendly.
- **Reliability**: Minimize downtime and ensure the application is available 99.9% of the time.
- **Scalability**: Design the system to scale efficiently as user demand grows.

### 5.5 Business Rules

Follow industry best practices for web development and adhere to relevant regulatory requirements.

---

## Other Requirements

None specified at this time.

---

## Appendix A: Glossary

- **FoSA**: Footwear Selection Application
- **UI**: User Interface
- **API**: Application Programming Interface
- **HTTPS**: Hypertext Transfer Protocol Secure
- **SQL**: Structured Query Language

---

## Appendix B: Analysis Models

Include diagrams and models such as C4 diagram.

C4 (Level 1)

![level1](https://github.com/zakur0-Sit/WEB/assets/126080046/1a7f8765-918f-4933-ab20-ac9a13b1fb0d)

C4 (Level 2)

![level2](https://github.com/zakur0-Sit/WEB/assets/126080046/a85073d0-b5c2-43d3-ac60-ccbf09f051cb)

C4 (Level 3)

![level3](https://github.com/zakur0-Sit/WEB/assets/126079873/44217b8f-c3e7-4fd1-88a3-4aa2ab32ee60)

C4 (Level 4)

![level4](https://github.com/zakur0-Sit/WEB/assets/126079873/8230b49f-90ea-4dc9-bf82-4cb078fac4ef)


