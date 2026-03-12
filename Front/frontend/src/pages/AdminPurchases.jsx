import { useEffect, useState } from "react";
import { getAllPurchases } from "../services/admin";

export default function AdminPurchases() {

  const [purchases, setPurchases] = useState([]);

  useEffect(() => {

    const fetchPurchases = async () => {
      const data = await getAllPurchases();
      setPurchases(data);
    };

    fetchPurchases();

  }, []);

  return (
    <div>

      <h1>Compras del sistema</h1>

      <table border="1">

        <thead>
          <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Juego</th>
            <th>Precio</th>
          </tr>
        </thead>

        <tbody>
          {purchases.map((purchase) => (
            <tr key={purchase.id}>

              <td>{purchase.user?.name}</td>
              <td>{purchase.user?.email}</td>
              <td>{purchase.game?.title}</td>
              <td>{purchase.game?.price} €</td>

            </tr>
          ))}
        </tbody>

      </table>

    </div>
  );
}