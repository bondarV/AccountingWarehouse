#  Warehouse Accounting System


A Laravel application for managing products, warehouses, inventories, stock movements, and purchases, with a focus on clean architecture, programming principles, and modern design patterns.

<strong>I contributed more attention in one place(Transition movement creation) where you can find open to extension controller but closed for modification</strong>

---

## Features

- **Product Management:** Create, view, update, and delete products.
- **Warehouse Management:** Add and manage multiple warehouses.
- **Inventory Tracking:** Monitor product quantities across warehouses.
- **Stock Operations:** Support for stock adjustments, relocations, and sales.
- **Purchase Handling:** Record user purchases and automatically notify users.
- **Notifications:** Automatic email notifications when purchases are confirmed.
- **Extensible Architecture:** Easily add new business rules or operations.

---

## Local Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/bondarV/AccountingWarehouse
   cd warehouse-accounting
2. **Install dependencies**
    ```bash
    composer install
    npm install
3. **Configure environment**

    ```bash
    cp .env.example .env
 + Open .env and set your database and mail credentials.

5. **Run your docker images**
    - docker should be downloaded and fired up
    ```bash
    ./vendor/bin/sail up -d
6. **Run migrations and seeders**
   - you can run from the sail(it directs to composer - main file) as well.
    ```bash
    docker exec -it ware...... 
    php artisan migrate --seed

## Programming Principles ## 

<ul>
  <li>
    <strong>Single Responsibility Principle (SRP):</strong>
    Each class and method is responsible for one thing only, improving maintainability.
    <code>Example: OperationHelper.php</code>
  </li>
  <li>
    <strong>Open/Closed Principle (OCP):</strong>
    The codebase is open for extension, but closed for modification by using strategies and extensible rules.
    <code>Example: Strategy classes</code>
  </li>
  <li>
    <strong>Don’t Repeat Yourself (DRY):</strong>
    Reusable logic is centralized in services and helpers to eliminate duplication.
    <code>Example: OperationHelper.php</code>
  </li>
  <li>
    <strong>Separation of Concerns:</strong>
    Business logic, validation, and data access are clearly separated into services, rules, and models.
  </li>
  <li>
    <strong>KISS (Keep It Simple, Stupid):</strong>
    The code prioritizes simplicity and readability over premature optimization.
  </li>
  <strong>I had certain battle with YAGNI as well, 'cause my validation could violate in some way concerns about repetitive code,so YAGNI is suitable in my case scenarip</strong>
</ul>

<h2>Design Patterns</h2>
<ul>
<p>TBF,there're a lot benefits in this framework,and needlessly to say,i didn't pay a lot attention at patterns(I mean implementation),I delved into how they work under the hood and become flexible with most of creational ones </p>
  <li>
    <strong>Strategy Pattern</strong><br>
    <code>Files:</code> AdjustStrategy.php, RelocateStrategy.php, SellingStrategy.php<br>
    <code>Purpose:</code> Encapsulates different stock operation algorithms, enabling flexible and extendable handling of inventory adjustments, relocations, and sales.
  </li>
  <li>
    <strong>Observer Pattern</strong><br>
    <code>Files:</code> PurchaseObserver.php<br>
    <code>Purpose:</code> Automatically notifies users when a purchase is created, decoupling notification logic from core business processes.
  </li>
  <li>
    <strong>Service Pattern</strong><br>
    <code>Files:</code> OperationHelper.php, OperationProcessService.php<br>
    <code>Purpose:</code> Centralizes domain operations and business workflows, enhancing modularity and testability.
  </li>
</ul>

<h2>Refactoring Techniques</h2>
<ul>
  <li>
    <strong>Extract Method:</strong><br>
    Moved complex logic from controllers to services for better readability.
  </li>
  <li>
    <strong>Encapsulate Field:</strong><br>
    Replaced direct field access with accessor methods and relationships.
  </li>
  <li>
    <strong>Replace Magic Strings/Numbers:</strong><br>
    Used enums and constants for better clarity and safety.<br>
    <code>Example:</code> MovementType.php
  </li>
  <li>
    <strong>Introduce Parameter Object:</strong><br>
    Utility methods receive associative arrays instead of long parameter lists.
  </li>
  <li>
    <strong>Move Method:</strong><br>
    Shifted methods to the most logical class (e.g., from controller to service or model).
  </li>

</ul>

![Screenshot from 2025-05-27 15-36-12.png](pics/Screenshot%20from%202025-05-27%2015-36-12.png)
