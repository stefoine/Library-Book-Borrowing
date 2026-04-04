# Library Book Borrowiing

## Entity-Relatinship Diagram
<img width="636" height="574" alt="Screenshot 2026-04-04 at 5 50 14 PM" src="https://github.com/user-attachments/assets/01dd0335-85f1-45d6-960b-15a7b75fcc4c" />

<img width="636" height="574" alt="Screenshot 2026-04-04 at 5 50 50 PM" src="https://github.com/user-attachments/assets/d9860267-4ed7-4e0b-9451-d1bc32503ae8" />

## Student Library Borrowing System
A simple Laravel-based library system designed for students to borrow and manage books efficiently. This project demonstrates proper use of database relationships including one-to-one, one-to-many, and many-to-many using Laravel Eloquent.

## Database Structure
Relationships:
- One-to-One:
    StudentAccount → StudentProfile
- One-to-Many:
    Book → Copies
- Many-to-Many:
    StudentProfile ↔ Copies (via borrow_records pivot table)
