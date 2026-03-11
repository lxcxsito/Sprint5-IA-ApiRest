import { useEffect, useState } from "react";
import { getTopBuyers } from "../services/stats";

export default function TopBuyers() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    const fetchUsers = async () => {
      try {
        const data = await getTopBuyers();
        setUsers(data);
      } catch (error) {
        console.error("Error cargando top buyers", error);
      }
    };

    fetchUsers();
  }, []);

  return (
    <div>
      <h1>Usuarios que más compran</h1>
      {users.map((user) => (
        <div key={user.id}>
          <h3>{user.name}</h3>
          <p>Compras: {user.games_count}</p>
        </div>
      ))}
    </div>
  );
}