# WHD Metal — API Reference

This document describes the main API endpoints, request parameters and example responses. The API routes are defined in `routes/api.php` and are served under the `/api` prefix (e.g. `/api/login`).

## Base URL
- If your app is served at `https://example.com`, the base API URL is `https://example.com/api`.

## Authentication
- Protected endpoints use Laravel Sanctum (`auth:sanctum`). After successful login you receive a plain-text token. Send it on subsequent requests in the `Authorization` header:

  `Authorization: Bearer <access_token>`

---

## 1) Login
- Endpoint: `POST /api/v1/login`
- Auth: no
- Content-Type: `application/json`
- Request body:

  ```json
  {
    "email": "user@example.com",
    "password": "secret-password"
  }
  ```

- Success response (200):

  ```json
  {
    "access_token": "<plain-text-token>",
    "token_type": "Bearer",
    "user": {
      "id": 1,
      "name": "Example User",
      "email": "user@example.com"
    }
  }
  ```

- Error response (401):

  ```json
  { "message": "Invalid credentials" }
  ```

---

## 2) List products
- Endpoint: `GET /api/v1/products`
- Auth: no
- Success response (200) — wrapped by `ApiResponse::success`:

  ```json
  {
    "success": true,
    "message": "Request was successful",
    "data": {
      "latestUpdate": "2025-11-21",
      "products": [
        {
          "id": 1,
          "name": "Steel Plate",
          "price": "123,45",
          "display_price": "<img ...> &euro; 123,45",
          "price_status": 0,
          "created_at": "21/11/2025",
          "updated_at": "21/11/2025"
        }
      ]
    },
    "errors": []
  }
  ```

---

## 3) Create product
- Endpoint: `POST /api/v1/products/create`
- Auth: required (`Authorization: Bearer <token>`)
- Content-Type: `application/json`
- Request body:

  ```json
  {
    "name": "Steel Plate",
    "price": 123.45,
    "price_status": 0
  }
  ```

- Validation rules:
  - `name`: required, string, max 1024
  - `price`: required, numeric, min 0
  - `price_status`: optional, one of `0`,`1`,`2`

- Success response (200):

  ```json
  {
    "success": true,
    "message": "Request was successful",
    "data": {
        "product": {
            "name": "Steel Plate",
            "price": "123",
            "price_status": "0",
            "updated_at": "2025-11-21T11:06:55.000000Z",
            "created_at": "2025-11-21T11:06:55.000000Z",
            "id": 1
        }
    },
    "errors": []
  }
  ```

- Validation error (422) — `ApiResponse::invalid` will return `errors` with field messages.

---

## 4) Update product
- Endpoint: `POST /api/v1/products/{product}/update`
- Auth: required
- Content-Type: `application/json`
- Request body: same as create
- Success response (200):

  ```json
  {
    "success": true,
    "message": "Request was successful",
    "data": {
        "product": {
            "name": "Steel Plate",
            "price": "123",
            "price_status": "0",
            "updated_at": "2025-11-21T11:06:55.000000Z",
            "created_at": "2025-11-21T11:06:55.000000Z",
            "id": 1
        }
    },
    "errors": []
  }

---

## 5) Delete product
- Endpoint: `DELETE /api/v1/products/{product}/delete`
- Auth: required
- Success response (200): `ApiResponse::success` wrapper

---

## Other endpoints (brief)
- `POST /api/devices` — register device token
  - Request body: `{ "firebase_token": "token", "platform": "android|ios" }`
- `POST /api/contact` — contact form
  - Request body: `first_name, last_name, email, phone, message, time_slot` (strings)
- `POST /api/order` — place an order (multipart/form-data)
  - Fields: `date, product_name, first_name, last_name, email, phone, message, address, postcode, residence, province, quantity, product, minimum_weight, time_slot, image` (image file required)
- `GET /api/initial` — returns app initial data and settings
- `POST /api/notification/send` — trigger a test notification

---

## Examples (curl)

- Login (JSON):

  ```bash
  curl -X POST "https://example.com/api/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"user@example.com","password":"secret"}'
  ```

- Create product (authenticated JSON):

  ```bash
  curl -X POST "https://example.com/api/products/create" \
    -H "Content-Type: application/json" \
    -H "Authorization: Bearer <token>" \
    -d '{"name":"Steel Plate","price":123.45,"price_status":0}'
  ```

- Place order (multipart with image):

  ```bash
  curl -X POST "https://example.com/api/order" \
    -H "Authorization: Bearer <token>" \
    -F "date=2025-11-21" \
    -F "product_name=30m" \
    -F "first_name=John" \
    -F "last_name=Doe" \
    -F "email=john@example.com" \
    -F "phone=123456789" \
    -F "message=Please deliver" \
    -F "address=Address line" \
    -F "postcode=12345" \
    -F "residence=City" \
    -F "province=Province" \
    -F "quantity=1" \
    -F "product=steel" \
    -F "minimum_weight=1000" \
    -F "time_slot=morning" \
    -F "image=@/path/to/file.jpg"
  ```

---

## Notes & next steps
- The API returns a consistent wrapper for most endpoints via the `ApiResponse` trait: `success|message|data|errors`.
- The `login` endpoint returns the token and user object directly.
- If you want, I can also:
  - add concrete JSON schema examples for validation errors,
  - create Form Request classes and API Resources to formalize request/response shapes,
  - or generate an OpenAPI/Swagger spec for the API.

Tell me which follow-up you'd like and I will implement it.
# WHD Metal — API Overview

This repository contains the API for the WHD Metal application. Per your request, I removed the temporary Request classes I previously added and left only this README change.

API endpoints (v1):

- POST `/api/v1/login` — login using `email` and `password`. Uses `auth:sanctum` to issue tokens.

- GET `/api/v1/products` — list products (public).

- POST `/api/v1/products/create` — create product (authenticated). Payload: `name`, `price`, `price_status` (0,1,2).

- POST `/api/v1/products/{product}/update` — update product (authenticated). Payload: `name`, `price`, `price_status`.

- DELETE `/api/v1/products/{product}/delete` — delete product (authenticated).

Other endpoints present in the API routes (non-exhaustive):

- POST `/api/v1/devices` — register device token.
- POST `/api/v1/contact` — contact form submission.
- POST `/api/v1/order` — place an order.
- GET `/api/v1/initial` — initial app data.
- POST `/api/v1/notification/send` — trigger a notification.

Notes:
- Authentication for protected routes uses Laravel Sanctum (`auth:sanctum`). The login endpoint issues a plain-text token via `$user->createToken(...)->plainTextToken`.
- If you want me to reintroduce Form Requests and Resources later, tell me which endpoints to convert and I'll add them (or create a separate branch).

If you want a different README content or to remove additional files, tell me and I will update it.
## Create Login Api
    POST method (v1/login)
    email and password send data

## Only login user
    ## Create Product
        POST method (v1/products/create)
        name, price and price_status(0,1,2)

    ## Update Product
        POST method (v1/products/{product}/update)
        name, price and price_status(0,1,2)

    ## Delete Product
        DELETE method (v1/products/{product}/delete)
