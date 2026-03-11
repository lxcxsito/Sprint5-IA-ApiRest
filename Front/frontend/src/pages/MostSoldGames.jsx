import { useEffect, useState } from "react";
import { getMostSoldGames } from "../services/stats";

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
    <div>
      <h1>Juegos más vendidos</h1>

      {games.map((game) => (
        <div key={game.id}>
          <h3>{game.title}</h3>
          <p>Ventas: {game.purchases_count}</p>
        </div>
      ))}
    </div>
  );
}