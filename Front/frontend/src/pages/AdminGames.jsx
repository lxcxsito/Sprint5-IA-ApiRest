import { useEffect, useState } from "react";
import { getGames } from "../services/games";
import { createGame, deleteGame } from "../services/admin";
import GameForm from "../components/GameForm";

export default function AdminGames() {

  const [games, setGames] = useState([]);

  const loadGames = async () => {
    const data = await getGames();
    setGames(data);
  };

  useEffect(() => {
    loadGames();
  }, []);

  const handleCreate = async (gameData) => {
    await createGame(gameData);
    loadGames();
  };

  const handleDelete = async (id) => {
    await deleteGame(id);
    loadGames();
  };

  return (
    <div>

      <h1>Admin - Gestión de juegos</h1>

      <GameForm onSubmit={handleCreate} />

      <h2>Lista de juegos</h2>

      {games.map((game) => (
        <div key={game.id}>

          <h3>{game.title}</h3>

          <button onClick={() => handleDelete(game.id)}>
            Borrar
          </button>

        </div>
      ))}

    </div>
  );
}