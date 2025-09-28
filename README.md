# Markodesign Test Task

## Setup Instructions

1. **Clone the project**
   ```bash
   git clone git@github.com:axellos/markodesign-test.git
   cd markodesign-test

⚠️ Make sure the following local ports are free, or change them via docker .env
* APP_PORT : **80**
* DB_PORT : **33060**
* REVERB_PORT : **8080**
* REDIS_PORT : **6379**

2. **Start Docker containers**
    ```bash
   docker compose up -d
3. **Enter the PHP container**
    ```bash
   docker compose exec php sh
4. **Initialize the project**
    ```bash
   make init
5. Done! The project is ready to use. 

* Application: http://localhost
* Horizon dashboard: http://localhost/horizon
* Swagger api documentation: http://localhost/api/documentation
* Exported postman collection is available in project root - **postman_collection.json**

## Tech Stack & Dependencies

> All dependencies are installed automatically via Docker. The list below is informational.

- **PHP v8.4** with Laravel 12.x
- **MySQL v8.2**
- **Redis v7.2** (caching & queues)
- **Laravel Horizon** (queue monitoring)
- **Reverb Reverb** (WebSocket server for real-time events)
- **Laravel Echo** (frontend real-time events)
- **Node.js v22 & Vite** (frontend tooling)
- **TailwindCSS** (styling)
- **Leaflet & OpenStreetMap API** (maps)
- **Swagger** (API documentation)

## Approach & Reasoning

When working on this task, my main goal was to keep the system **reliable, and easy to extend** later if needed.  
I also tried to rely on **first-party Laravel tools** where possible and **free/open-source services** like OpenStreetMap to avoid unnecessary complexity or costs.

## Stack & Services

- **PHP-FPM + Nginx** - A solid and proven setup for running Laravel based application with good performance.
- **MySQL** - A reliable relational database that works well for structured data.
- **Redis** - Used both for in-memory database and as the queue driver.
- **Laravel Horizon** - First-party tool that gives a clear view of queues and workers.
- **Reverb** - First-party solution for handling WebSockets.
- **Vite** - A modern default bundler that improves frontend development workflow.
- **TailwindCSS** - Used for quick, consistent, and responsive styling without writing a lot of custom CSS.
- **Plain JavaScript** - Enough for this task because frontend is the secondary.
- **Leaflet + OpenStreetMap** - Free and open-source mapping solution for showing courier locations.
- **Swagger** - Default tool for API documentation, making endpoints easy to explore and test.
- **Docker + Docker Compose** - Ensures everything runs in isolated, reproducible containers.
- **Makefile** - Provides simple command for project initialization.

## Containers & Processes

- **Separate containers** for:
    - **Reverb** (WebSocket server)
    - **Horizon** (queue worker and monitoring)

- **PHP container** runs with **Supervisor**, handling two processes:
    - `php-fpm` for web requests
    - Laravel **Scheduler** for background tasks (like syncing data)

---

## Architecture Choices

- **Courier locations in a separate table** with a one-to-one relation - makes it easier to add features later (like history tracking).
- **Redis-first**: locations are stored in Redis first to reduce the number of direct writes into MySQL.
    - A scheduled job syncs Redis data to MySQL every minute → balances performance with durability.
- **WebSockets**: for simplicity, a public channel is used here.
    - In production, this should be private with authentication for security.
- **Sync job**: currently all syncing is handled by a single job.
    - This could be split into multiple jobs (e.g., chunked data) if the volume grows.  
