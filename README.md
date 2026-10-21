# CARDIA — Coronary Artery Disease Prediction

CARDIA is a web application that estimates a patient's risk of **coronary artery disease (CAD)** from routine clinical data: medical history, blood work, ECG measurements and lifestyle factors. A clinician fills in a guided 5-step form. The app sends the data to a machine-learning model and shows the prediction with its class probabilities.

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-SQLite-4479A1?logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-6-646CFF?logo=vite&logoColor=white)
![Railway](https://img.shields.io/badge/Deploy-Railway-0B0D0E?logo=railway&logoColor=white)

> ⚠️ **Disclaimer:** this is a research / educational project. It is **not** a certified medical device and must not be used for real diagnosis.

---

## Features

- **Guided 5-step prediction form.** Each step is validated on the server, and you can't skip ahead.
  1. Demographics & BMI class
  2. Medical history (hypertension, diabetes, kidney failure, COPD)
  3. Biology (CRP, MDRD class, fasting glucose, HDL-C, HbA1c, non-HDL)
  4. ECG (PR interval, QRS duration/fragmentation, ST amplitudes, Q wave, TPE…)
  5. Habits & symptoms (smoking, chest pain)
- **ECG auto-fill from an image.** Upload a photo of an ECG report and Tesseract OCR extracts the PR, QRS and ST values into step 4.
- **ML-powered prediction.** The form data goes to an external FastAPI model service. The result page shows the predicted class and the probabilities.
- **Prediction history.** Every prediction is stored in the database.
- **Admin dashboard.** Patient statistics (age distribution, CAD vs. non-CAD) built from an Excel dataset, plus user management.
- **Authentication & roles.** Login, registration, email verification and profile management via Laravel Breeze, with `user` / `admin` roles.
- **Open demo.** Guests can try the model without creating an account.

## Architecture

The Laravel app does **not** contain the model itself. The model runs as a separate Python (FastAPI) service, and Laravel calls it over HTTP:

```
┌──────────────┐   5-step form   ┌─────────────────────┐   POST /predict   ┌──────────────────────┐
│   Browser    │ ──────────────► │   Laravel 12 app    │ ────────────────► │  FastAPI model API   │
│ (Blade, Vite)│ ◄────────────── │  (this repository)  │ ◄──────────────── │ (Hugging Face Space) │
└──────────────┘   result page   └─────────┬───────────┘   prediction +    └──────────────────────┘
                                           │               probabilities
                                ┌──────────┴──────────┐
                                │  MySQL / SQLite     │   users, prediction_results
                                │  Tesseract OCR      │   ECG image → form values
                                └─────────────────────┘
```

Because the model is a separate service, it can be retrained and redeployed without touching the web app, as long as the `/predict` contract stays the same.

## Tech stack

| Layer      | Technology                                                       |
| ---------- | ---------------------------------------------------------------- |
| Backend    | PHP 8.2+, Laravel 12, Laravel Breeze (auth)                      |
| Frontend   | Blade templates, Vite, Bootstrap 5, Tailwind CSS, Alpine.js      |
| Database   | MySQL (production), SQLite (local default)                       |
| ML service | Python / FastAPI, hosted separately (e.g. Hugging Face Spaces)   |
| OCR        | Tesseract via `thiagoalessio/tesseract_ocr`                      |
| Data       | `maatwebsite/excel` for the dashboard dataset                    |
| Deployment | Railway (Railpack builder)                                       |

## Getting started

### Prerequisites

- PHP **8.2+** with the `gd`, `zip` and `pdo_mysql` extensions
- Composer
- Node.js 18+ and npm
- *(optional)* [Tesseract OCR](https://github.com/tesseract-ocr/tesseract) for ECG image extraction
- A running instance of the CAD model API (local or remote)

### Installation

```bash
git clone https://github.com/AbdesslemSfaihi/Coronary-Artery-Disease-Application.git
cd Coronary-Artery-Disease-Application

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed   # creates tables + the admin account
npm run build
```

### Run locally

```bash
composer dev
```

This starts the Laravel server, queue worker, log viewer and Vite together. Open <http://localhost:8000>.

> If your model API also runs locally on port 8000, start Laravel on another port (`php artisan serve --port=8080`) and point `MODEL_API_URL` at the model.

## Configuration

Besides the standard Laravel variables, set these in `.env`:

| Variable          | Description                                                    | Default                 |
| ----------------- | -------------------------------------------------------------- | ----------------------- |
| `MODEL_API_URL`   | Base URL of the FastAPI model service (`/predict` is appended) | `http://127.0.0.1:8000` |
| `TESSERACT_PATH`  | Full path to the Tesseract binary. Leave empty on Linux to use `PATH`; on Windows, point it at `tesseract.exe` | *(empty)* |
| `DB_CONNECTION`   | `sqlite` locally, `mysql` in production                        | `sqlite`                |

If Tesseract isn't installed, the app still works. The image upload just shows a message asking for manual entry.

## Model API contract

`POST {MODEL_API_URL}/predict`

```jsonc
// Request
{
  "data": {
    "Age": 62,
    "Sexe": 1,
    "Biologie_HbA1C": 7.1,
    "ECG_QRS duration (ms)": 96,
    // … 28 features in total, see PredictionController::submitForm
  }
}

// Response
{
  "prediction": 1,
  "probabilities": [0.23, 0.77]
}
```

The feature names must match the columns the model was trained on exactly, including accents and trailing spaces.

## Project structure

```
app/
├── Http/Controllers/
│   ├── PredictionController.php   # multi-step form, OCR, call to model API
│   ├── SeverityController.php     # severity staging (currently mocked)
│   ├── DashboardController.php    # admin statistics from Excel dataset
│   └── Admin/UserController.php   # admin user management
└── Models/
    ├── PredictionResult.php
    └── User.php
resources/views/
├── predict-form-step1..5.blade.php
├── predict-result.blade.php
└── admin/
routes/web.php
railway.json                       # Railway build & deploy config
```

## Deployment (Railway)

The project ships with a [`railway.json`](railway.json):

- builds with **Railpack**
- runs `php artisan migrate --force && php artisan db:seed --force` before each deploy
- health check on `/up`

Add a MySQL service in Railway, then set the `DB_*` variables, `APP_KEY`, `APP_URL` and `MODEL_API_URL` on the web service.

## Testing

```bash
composer test
```

## Roadmap

- [ ] Connect the severity classifier (`/classify`) to a real model (it currently returns a mock response)
- [ ] Explainability (feature importance / SHAP) on the result page
- [ ] Feature tests for the prediction flow

## Author

**Abdesslem Sfaihi** — [GitHub](https://github.com/AbdesslemSfaihi)
