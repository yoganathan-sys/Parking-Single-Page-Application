# 🚗 Yoga's Parking Management System (SPA)

A modern, responsive Single Page Application (SPA) designed to manage car parking records, vehicle check-ins, charge tracking, and live status updates with a sleek dark-glassmorphism user interface.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.6-7952B3?logo=bootstrap&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-3.7-0769AD?logo=jquery&logoColor=white)
![Vercel](https://img.shields.io/badge/Deploy-Vercel-000000?logo=vercel&logoColor=white)

---

## ✨ Features

- 🚘 **Vehicle Registration:** Add new vehicles with car number, model name, owner name, and parking fees via a draggable modal.
- 📋 **Live Management Dashboard:** View all currently parked cars with real-time timestamps.
- ✏️ **Inline Record Editing:** Update vehicle details and rates directly on the dashboard.
- 🗑️ **Instant Checkout / Removal:** Delete records with confirmation prompts.
- 🎨 **Modern Glassmorphism UI:** Built with dark theme gradients, blur backdrops, and Poppins typography.
- ☁️ **Cloud Ready:** Configured for Vercel Serverless runtime (`vercel.json`) with environment-variable database support.

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.x
- **Database:** MySQL / MariaDB (or cloud MySQL such as TiDB, Aiven, or Clever Cloud)
- **Frontend:** HTML5, CSS3 (Glassmorphism), Bootstrap 4.6, jQuery, jQuery UI, FontAwesome 6
- **Deployment:** Vercel / Apache / XAMPP

---

## 📂 Project Structure

```text
├── .gitignore          # Git ignore rules for archives, env, and OS files
├── config.php          # Database configuration with Cloud & Local fallback
├── del1.php            # Vehicle deletion handler
├── index.php           # Main single page application dashboard
├── Parkmain.php        # Application entry alias
├── park1.sql           # Database schema & sample seed data
├── vercel.json         # Vercel serverless deployment config
└── README.md           # Documentation
```

---

## 🚀 Local Setup (XAMPP)

1. **Clone or move the project** to your local server directory:
   ```bash
   # In XAMPP htdocs:
   cd C:/xampp/htdocs/
   git clone https://github.com/yoganathan-sys/Parking-Single-Page-Application.git "Parking System SPA"
   ```

2. **Start Apache & MySQL** in the XAMPP Control Panel.

3. **Import Database:**
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a new database named `park`.
   - Click **Import** and select the [park1.sql](file:///c:/xampp/htdocs/Project/Parking%20System%20SPA/park1.sql) file.

4. **Launch the application:**
   - Open your browser and navigate to:
     ```
     http://localhost/Project/Parking%20System%20SPA/
     ```

---

## ☁️ Deploying to Vercel

### Step 1: Set Up a Free Cloud MySQL Database
Because Vercel is a serverless platform without a built-in persistent database, create a free cloud MySQL instance on:
- [TiDB Cloud](https://tidbcloud.com/) *(Recommended, free tier)*
- [Aiven](https://aiven.io/mysql) *(Free trial / free tier)*
- [Clever Cloud](https://www.clever-cloud.com/)
- [Supabase / PlanetScale / Railway]

After creating your database, import the SQL schema from [park1.sql](file:///c:/xampp/htdocs/Project/Parking%20System%20SPA/park1.sql).

### Step 2: Deploy on Vercel
1. Go to [vercel.com](https://vercel.com) and log in with your GitHub account.
2. Click **Add New...** > **Project**.
3. Import your GitHub repository: `yoganathan-sys/Parking-Single-Page-Application`.
4. In the **Environment Variables** section, add your database credentials:
   - `DB_HOST`: Your cloud database host (e.g. `gateway01.us-east-1.prod.aws.tidbcloud.com`)
   - `DB_USER`: Your cloud database username
   - `DB_PASS`: Your cloud database password
   - `DB_NAME`: `park` (or your database name)
   - `DB_PORT`: `3306` (or your cloud port)
5. Click **Deploy**. Vercel will automatically build and publish your application.

---

## 📤 How to Push Changes to GitHub

To push your latest clean code to GitHub:

```bash
# 1. Check current status
git status

# 2. Stage all updated files
git add .

# 3. Commit the changes
git commit -m "feat: format codebase for GitHub and configure Vercel deployment"

# 4. Push to main branch
git push origin main
```

---

## 📜 License
This project is open-source and available under the [MIT License](LICENSE).
