from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import joblib
import numpy as np
import pandas as pd

# Load trained components
model = joblib.load("coro_model.pkl")     # Calibrated stacked model
scaler = joblib.load("scaler.pkl")        # StandardScaler
imputer = joblib.load("imputer.pkl")      # KNNImputer
selected_features = joblib.load("features.pkl")  # List of selected features

app = FastAPI(title="Coro Result Prediction API (Stacked & Calibrated)")

# Define input schema
class PatientData(BaseModel):
    data: dict  # Input should contain all selected feature keys

@app.post("/predict")
def predict(payload: PatientData):
    try:
        input_dict = payload.data

        # Check for missing fields
        missing = [f for f in selected_features if f not in input_dict]
        if missing:
            raise HTTPException(status_code=422, detail=f"Missing fields: {missing}")

        # Construct input DataFrame
        X_raw = pd.DataFrame([input_dict])[selected_features]

        # Step-by-step preprocessing
        X_imputed = imputer.transform(X_raw)
        X_scaled = scaler.transform(X_imputed)

        # Predict
        y_proba = model.predict_proba(X_scaled)[0]  # Get full probability array: [prob_0, prob_1]
        y_pred = int(y_proba[1] >= 0.48)  # Use your optimal threshold

        return {
            "prediction": y_pred,
            "probability": round(float(y_proba[1]), 4),
            "probabilities": {
                0: round(float(y_proba[0]), 4),
                1: round(float(y_proba[1]), 4)
            },
            "status": "success"
        }

    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))
