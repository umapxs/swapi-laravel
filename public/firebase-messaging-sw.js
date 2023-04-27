// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDUBT2qrSj_2zk8mz924B-XckJ7hj5j-zE",
    authDomain: "swapi-project-5c2da.firebaseapp.com",
    projectId: "swapi-project-5c2da",
    storageBucket: "swapi-project-5c2da.appspot.com",
    messagingSenderId: "233401070736",
    appId: "1:233401070736:web:99b013c59b4435f5f35415",
    measurementId: "G-8BLS7MLGSV",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
