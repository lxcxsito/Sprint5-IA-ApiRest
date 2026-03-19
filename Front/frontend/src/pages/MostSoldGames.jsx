import { useEffect, useState } from "react";
import { getMostSoldGames } from "../services/stats";
import "./Stats.css";

export default function MostSoldGames() {
  const [games, setGames] = useState([]);

  useEffect(() => {
    const fetchGames = async () => {
      try {
        const data = await getMostSoldGames();
        setGames(data);
      } catch (error) {
        console.error("Error cargando más vendidos", error);
      }
    };

    fetchGames();
  }, []);

  return (
    <div className="stats-container">

      <h1>🔥 Juegos más vendidos</h1>

      <div className="stats-list">

        {games.map((game, index) => (
          <div className="stats-card" key={game.id}>

            <div className="stats-info">
              <span className="stats-title">
                #{index + 1} {game.title}
              </span>
              <span className="stats-sub">Total de ventas</span>
            </div>

            <span className="stats-value">
              🛒 {game.purchases_count}
            </span>

          </div>
        ))}

      </div>
    </div>
  );
}