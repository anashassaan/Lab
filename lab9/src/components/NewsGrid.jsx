import ArticleCard from './ArticleCard'

function NewsGrid({ articles, loading, error }) {
  if (loading) {
    return <div className="status-message">Loading the latest headlines...</div>
  }

  if (error) {
    return (
      <div className="status-message">
        Unable to reach the News API right now.
        <br />
        <small>{error}</small>
      </div>
    )
  }

  if (!articles || articles.length === 0) {
    return <div className="status-message">No results for this filter. Try another combination.</div>
  }

  return (
    <section className="news-grid">
      {articles.map((article, index) => (
        <ArticleCard key={article.url ?? index} article={article} />
      ))}
    </section>
  )
}

export default NewsGrid
