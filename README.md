# 🫀 CoroPredict – Intelligent CAD Prediction System

![License](https://img.shields.io/badge/License-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![FastAPI](https://img.shields.io/badge/FastAPI-0.115-green?logo=fastapi)
![Python](https://img.shields.io/badge/Python-3.10-yellow?logo=python)
![PHP](https://img.shields.io/badge/PHP-8.2-purple?logo=php)

---

## 📌 Overview
**CoroPredict** is a full-stack intelligent system for predicting **Coronary Artery Disease (CAD)** using **machine learning**.  
The system helps doctors input patient data and receive **real-time CAD risk predictions** along with **risk-based recommendations**.

Developed as part of a **Software Engineering graduation thesis (2025)**.

---

## 🚀 Features
- 🔐 **Secure Authentication** for doctors  
- 📝 **Patient Data Entry** (clinical, biological, ECG & lifestyle data)  
- ⚡ **Real-Time CAD Risk Prediction** using a trained ML stacking model  
- 📊 **Risk-based Recommendations** for follow-up and treatment guidance  
- 🌐 **Web-Based Interface** with responsive and user-friendly design  

---

## 🛠️ Tech Stack
- **Frontend & Backend**: [Laravel 12](https://laravel.com/)  
- **Machine Learning API**: [FastAPI](https://fastapi.tiangolo.com/) + Python (scikit-learn, XGBoost)  
- **Database**: MySQL / MariaDB  
- **Deployment**: Uvicorn (FastAPI) + Laravel Artisan  

---


## ⚙️ Installation & Setup

### 1️⃣ Clone Repository
```bash
git clone https://github.com/AbdesslemSfaihi/Coronary-Artery-Disease-Application.git
cd Coronary-Artery-Disease-Application
```

## Setup Laravel

cd laravel-app
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve

## ⚙️ Setup FastAPI

1. Create a folder containing:
   - `main.py` (your FastAPI code)
   - `requirements.txt`

2. In the terminal, run the following:

```bash
# Create virtual environment
python -m venv venv
```
# Activate venv
source venv/bin/activate   # (Linux/Mac) 
 venv\Scripts\activate      # (Windows)

# Install dependencies
pip install -r requirements.txt
📦 requirements.txt

fastapi==0.115.0
uvicorn==0.30.1
pydantic==2.9.2
joblib==1.4.2
numpy==1.26.4
pandas==2.2.3
scikit-learn==1.5.1
xgboost==2.1.1
Start the FastAPI server:

uvicorn main:app --reload
🧠 Machine Learning Model
Algorithms Used: Logistic Regression, Random Forest, XGBoost

Final Approach: Stacking Ensemble with calibration

Performance:

✅ Accuracy: 83%

📈 ROC AUC: 0.865

⚖️ Balanced precision & recall

---
