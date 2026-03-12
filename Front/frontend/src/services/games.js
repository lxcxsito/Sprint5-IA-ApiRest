import {api} from "./api";

export const getGames = async () => {
  const response = await api.get("/games");
  return response.data;
};

export const getGameById = async (id) => {
  const response = await api.get(`http://localhost:8000/api/games/${id}`);
  return response.data;
};