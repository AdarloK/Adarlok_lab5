# Product CRUD deployment

## Aiven

Create the `products` table in the existing Aiven MySQL database, or run LavaLust's migration command after setting the database environment variables. The table must contain `id`, `product_name`, `description`, `price`, `quantity`, and `created_at`.

## Local configuration

Copy `.env.example` to `.env` and fill in the Aiven values. This repository ignores `.env`; never commit database credentials. Set `ADMIN_USERNAME` and `ADMIN_PASSWORD_HASH` for the product manager login.

## Render

Create a new Render Web Service from the GitHub repository and choose Docker. Render can use `render.yaml` as a blueprint. Set every `sync: false` environment variable in the Render dashboard, including the Aiven host, port, username, password, database name, and admin password hash.

The application flow is:

1. Open `/login`.
2. Sign in with `ADMIN_USERNAME` and the password represented by `ADMIN_PASSWORD_HASH`.
3. Use `/products` to create, read, update, and delete products.
4. Use `/logout` to end the session.

All product routes are guarded by `AuthMiddleware`; unauthenticated requests redirect to `/login`.
