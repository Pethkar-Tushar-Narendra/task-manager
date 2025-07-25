
# ✅ Task Manager with Laravel Jetstream & jQuery AJAX

A simple Task Manager web application built with **Laravel 10**, **Jetstream (Livewire)** for authentication, and **jQuery AJAX** for a seamless CRUD experience without page reloads.

---

## ✨ Features

- ✅ **User Authentication** – Login / Register / Logout via Laravel Jetstream
- 📝 **Task Management (CRUD)** – Add, edit, delete, and view tasks
- 🔁 **Toggle Task Status** – Mark tasks as `Pending` or `Done`
- 🚀 **AJAX-powered UI** – No page reloads, all actions via jQuery AJAX
- 👤 **User Scoped Tasks** – Each user sees only their own tasks
- 🧼 **Bootstrap UI** – Clean and responsive UI with modals

---

## 🛠 Tech Stack

- **Laravel 10+**
- **Laravel Jetstream (Livewire)**
- **MySQL**
- **Bootstrap 5**
- **jQuery (AJAX)**

---

## 📦 Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Frontend Dependencies
```bash
npm install && npm run dev
```

### 4. Configure Environment
- Copy `.env.example` to `.env`
```bash
cp .env.example .env
```
- Set your database credentials:
```env
DB_DATABASE=your_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate App Key & Run Migrations
```bash
php artisan key:generate
php artisan migrate
```

### 6. Start Development Server
```bash
php artisan serve
```

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧪 How to Use

1. **Register/Login**
2. Redirects to the **Dashboard**
3. Click **Manage Tasks** to:
   - ➕ Add Task via modal (AJAX)
   - ✏️ Edit Task via modal (AJAX)
   - ❌ Delete Task (AJAX)
   - 🔁 Toggle Task Status (AJAX)

All actions are done **without page reloads** using jQuery AJAX.

---

## 🛢 Database

- The `tasks` table is used to store task data.
- A `tasks.sql` export is provided for structure reference.

---

## 📁 SQL File

If needed, import using:
```bash
mysql -u your_username -p your_database < tasks.sql
```

---

## 🙋‍♂️ Developed By

**Tushar Pethkar**  
[Nashik, Maharashtra, India]

---

## 📬 Contact

📧 pethkartusharnarendra@gmail.com  
---
