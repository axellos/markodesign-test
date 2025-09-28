# Markodesign Test Task

## Setup Instructions

1. **Clone the project**
   ```bash
   git clone git@github.com:axellos/markodesign-test.git
   cd markodesign-test

⚠️ Make sure the following local ports are free, or change them via docker .env
* APP_PORT : **80**
* DB_PORT : **3306**
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
5. Done! The project is ready to use. The application is available at http://localhost. Horizon dashboard is available at http://localhost/horizon

