import { useEffect, useState } from "react";
import { getGames } from "../services/games";
import { createGame, deleteGame } from "../services/admin";
import GameForm from "../components/GameForm";
import "./AdminGames.css";

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
    <div className="admin-container">
      <h1 className="admin-title">🎮 Admin – Gestión de Juegos</h1>

      <GameForm onSubmit={handleCreate} />

      <h2 className="admin-subtitle">Lista de juegos</h2>

      <div className="admin-list">
        {games.map((game) => (
          <div key={game.id} className="admin-item">
            <span className="game-title">{game.title}</span>

            <button
              className="delete-btn"
              onClick={() => handleDelete(game.id)}
            >
              Borrar
            </button>
          </div>
        ))}
      </div>
    </div>
  );
}