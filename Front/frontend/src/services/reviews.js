import { api } from "./api";

export const getReviews = async (gameId) => {
  const res = await api.get(`/games/${gameId}/reviews`);
  return res.data;
};

export const createReview = async (gameId, reviewData) => {
  const res = await api.post(`/games/${gameId}/reviews`, reviewData);
  return res.data;
};