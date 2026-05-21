# System Specification Document (SSD)
**Project:** Warehouse Accounting System

**Development Cycle:** 2025

## 1. System Architecture
The system uses the MVC pattern with a "Thin Controllers & Fat Services" approach. Business logic is isolated within the Service layer and Strategy classes, ensuring adherence to SOLID principles (SRP, OCP).

## 2. Technology Stack
- **Backend:** PHP 8.2, Laravel 12.0
- **Frontend:** Tailwind CSS 4.0, Livewire 3.6, Vite 6.2
- **Database:** MySQL / SQLite
- **Environment:** Docker (Laravel Sail)

## 3. Logical Data Model
- `User`: System users and customers.
- `Warehouse` & `Product`: Main inventory entities.
- `Inventory`: Pivot table storing current stock quantity.
- `StockMovement`: Audit log for all operations.
- `Purchase`: Registry of customer orders.

## 4. Software Design Patterns
- **Strategy Pattern:** Used for stock operations (`AdjustStrategy`, `RelocateStrategy`, `SellingStrategy`).
- **Observer Pattern:** `PurchaseObserver` triggers emails when a purchase is created.
- **Service Pattern:** `OperationProcessService` encapsulates validation logic to keep controllers clean.
