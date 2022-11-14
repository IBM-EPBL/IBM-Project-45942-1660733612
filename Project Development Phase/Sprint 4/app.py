from flask import Flask, render_template, request
import numpy as np
import pickle


app = Flask(__name__)
model = pickle.load(open('Liver2.pkl', 'rb'))

@app.route('/',methods=['GET'])
def Home():
    return render_template('home.htm')

@app.route("/predict", methods=['POST'])
def predict():
    if request.method == 'POST':
        Age = int(request.form.get('Age', False))
        Gender = int(request.form.get('Gender',False))
        Total_Bilirubin = float(request.form.get('Total_Bilirubin',False))
        Alkaline_Phosphotase = int(request.form.get('Alkaline_Phosphotase',False))
        Alamine_Aminotransferase = int(request.form.get('Alamine_Aminotransferase',False))
        Aspartate_Aminotransferase = int(request.form.get('Aspartate_Aminotransferase',False))
        Total_Protiens = float(request.form.get('Total_Protiens',False))
        Albumin = float(request.form.get('Albumin',False))
        Albumin_and_Globulin_Ratio = float(request.form.get('Albumin_and_Globulin_Ratio',False))


        values = np.array([[Age,Gender,Total_Bilirubin,Alkaline_Phosphotase,Alamine_Aminotransferase,Aspartate_Aminotransferase,Total_Protiens,Albumin,Albumin_and_Globulin_Ratio]])
        prediction = model.predict(values)

        return render_template('result1.html', prediction=prediction)


if __name__ == "__main__":
    app.run(debug=True)