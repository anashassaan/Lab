import { useCallback, useEffect, useState } from 'react'
import { fetchTopHeadlines } from '../services/newsApi'

function useNewsFeed(activeFilters) {
  const [articles, setArticles] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')

  const loadArticles = useCallback(
    async (incomingFilters) => {
      setLoading(true)
      setError('')
      try {
        const data = await fetchTopHeadlines(incomingFilters ?? activeFilters)
        setArticles(data)
      } catch (err) {
        setError(err.message || 'Unable to load headlines right now.')
      } finally {
        setLoading(false)
      }
    },
    [activeFilters],
  )

  useEffect(() => {
    loadArticles(activeFilters)
  }, [activeFilters, loadArticles])

  const refresh = useCallback(() => loadArticles(activeFilters), [activeFilters, loadArticles])

  return { articles, loading, error, refresh }
}

export default useNewsFeed
