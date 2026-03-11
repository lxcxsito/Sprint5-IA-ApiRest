import { api } from "./api";

export const purchaseGame = async (gameId) => {
  const response = await api.post(`/purchases/${gameId}`);
  return response.data;
};

export const getMyGames = async () => {
  const response = await api.get("/my-games");
  return response.data;
};