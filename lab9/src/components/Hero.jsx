function Hero({ eyebrow, title, subtitle, ctaLabel, onCta, ctaHref, disabled = false }) {
  const buttonClass = ctaHref ? 'secondary-btn' : 'primary-btn'
  const isButton = Boolean(onCta) && !ctaHref

  return (
    <section className="hero">
      {eyebrow && <p className="hero-eyebrow">{eyebrow}</p>}
      <h1>{title}</h1>
      {subtitle && <p>{subtitle}</p>}
      {ctaLabel && (
        <div className="hero-actions">
          {isButton ? (
            <button type="button" className={buttonClass} disabled={disabled} onClick={onCta}>
              {ctaLabel}
            </button>
          ) : (
            <a className={buttonClass} href={ctaHref} target="_blank" rel="noreferrer">
              {ctaLabel}
            </a>
          )}
        </div>
      )}
    </section>
  )
}

export default Hero
