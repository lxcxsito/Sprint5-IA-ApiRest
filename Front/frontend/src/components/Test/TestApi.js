import { useEffect } from "react";
import axios from "axios";

export default function TestApi() {
  useEffect(() => {
    axios
      .get("http://localhost:8000/api/games")
      .then((res) => {
        console.log("Respuesta de la API:", res.data);
      })
      .catch((err) => {
        console.error("Error:", err);
      });
  }, []);

  return <h2>Probando API...</h2>;
}