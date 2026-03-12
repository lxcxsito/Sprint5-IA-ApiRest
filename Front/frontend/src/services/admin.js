import {api} from "./api";

export const createGame = async (gameData) => {
  const response = await api.post("/games", gameData);
  return response.data;
};

export const updateGame = async (id, gameData) => {
  const response = await api.put(`/games/${id}`, gameData);
  return response.data;
};

export const deleteGame = async (id) => {
  const response = await api.delete(`/games/${id}`);
  return response.data;
};

export const getAllPurchases = async () => {
  const response = await api.get("/purchases");
  return response.data;
};