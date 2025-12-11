function formatPublishedAt(value) {
  if (!value) return 'Unknown time'
  try {
    return new Intl.DateTimeFormat('en', {
      dateStyle: 'medium',
      timeStyle: 'short',
    }).format(new Date(value))
  } catch (_error) {
    return value
  }
}

function ArticleCard({ article }) {
  const image = article.urlToImage
  const source = article.source?.name ?? 'News API'

  return (
    <article className="article-card">
      {image ? (
        <img className="article-image" src={image} alt={article.title} loading="lazy" />
      ) : (
        <div className="article-image" aria-hidden="true" />
      )}
      <div className="article-body">
        <p className="article-source">{source}</p>
        <h3 className="article-title">
          {article.url ? (
            <a href={article.url} target="_blank" rel="noreferrer">
              {article.title}
            </a>
          ) : (
            article.title
          )}
        </h3>
        <p className="article-description">{article.description || 'No summary provided.'}</p>
        <div className="article-footer">
          <span>{article.author || 'Unknown author'}</span>
          <span> · {formatPublishedAt(article.publishedAt)}</span>
        </div>
      </div>
    </article>
  )
}

export default ArticleCard
