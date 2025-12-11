import axios from 'axios'
import sampleData from '../data/sample-news.json'

const newsClient = axios.create({
  baseURL: 'https://newsapi.org/v2',
  timeout: 8000,
})

const FALLBACK_ARTICLES = sampleData.articles

export async function fetchTopHeadlines({ country = 'us', category = 'technology' } = {}) {
  const apiKey = import.meta.env.VITE_NEWS_API_KEY
  if (!apiKey) {
    console.warn('Missing VITE_NEWS_API_KEY. Falling back to bundled sample headlines.')
    return FALLBACK_ARTICLES
  }

  try {
    const start = performance.now()
    const response = await newsClient.get('/top-headlines', {
      params: {
        country,
        category,
        pageSize: 12,
        apiKey,
      },
    })

    if (response.data?.status !== 'ok') {
      throw new Error(response.data?.message || 'News API returned an error.')
    }

    const articles = response.data.articles ?? FALLBACK_ARTICLES
    const latency = Math.round(performance.now() - start)
    return articles.map((article) => ({ ...article, latency }))
  } catch (error) {
    console.error('News API request failed:', error.message)
    return FALLBACK_ARTICLES
  }
}
