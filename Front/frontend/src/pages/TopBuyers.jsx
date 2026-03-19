import { useEffect, useState } from "react";
import { getTopBuyers } from "../services/stats";
import "./Stats.css";

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
    <div className="stats-container">

      <h1>🏆 Top compradores</h1>

      <div className="stats-list">

        {users.map((user, index) => (
          <div className="stats-card" key={user.id}>

            <div className="stats-info">
              <span className="stats-title">
                #{index + 1} {user.name}
              </span>
              <span className="stats-sub">Total compras</span>
            </div>

            <span className="stats-value">
              🎮 {user.games_count}
            </span>

          </div>
        ))}

      </div>
    </div>
  );
}