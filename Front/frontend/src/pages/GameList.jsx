import { useEffect, useState } from "react";
import { getGames } from "../services/games";
import GameCard from "../components/GameCard";

export default function GameList() {
  const [games, setGames] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchGames = async () => {
      try {
        const data = await getGames();
        setGames(data);
      } catch (error) {
        console.error("Error cargando juegos", error);
      } finally {
        setLoading(false);
      }
    };

    fetchGames();
  }, []);

  if (loading) return <p>Cargando juegos...</p>;

  return (
    <div>
      <h1>Tienda de Juegos</h1>

      <div style={{ display: "flex", gap: "20px", flexWrap: "wrap" }}>
        {games.map((game) => (
          <GameCard key={game.id} game={game} />
        ))}
      </div>
    </div>
  );
}