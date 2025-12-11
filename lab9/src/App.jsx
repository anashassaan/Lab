import { useState } from 'react'
import { NavLink, Route, Routes } from 'react-router-dom'
import Hero from './components/Hero'
import FiltersBar from './components/FiltersBar'
import NewsGrid from './components/NewsGrid'
import RequestPlayground from './components/RequestPlayground'
import useNewsFeed from './hooks/useNewsFeed'
import './App.css'

const categoryOptions = [
  { label: 'Technology', value: 'technology' },
  { label: 'Business', value: 'business' },
  { label: 'Science', value: 'science' },
  { label: 'Health', value: 'health' },
  { label: 'Sports', value: 'sports' },
]

const countryOptions = [
  { label: 'United States', value: 'us' },
  { label: 'Canada', value: 'ca' },
  { label: 'United Kingdom', value: 'gb' },
  { label: 'Australia', value: 'au' },
  { label: 'India', value: 'in' },
  { label: 'Pakistan', value: 'pk' },
]

function App() {
  const [filters, setFilters] = useState({ country: 'us', category: 'technology' })
  const { articles, loading, error, refresh } = useNewsFeed(filters)

  const handleFilterChange = (name, value) => {
    setFilters((prev) => ({ ...prev, [name]: value }))
  }

  return (
    <div className="app-shell">
      <header className="app-header">
        <div className="brand">
          <div className="brand-mark">Pulsewire</div>
        </div>
        <nav className="app-nav">
          <NavLink to="/" className={({ isActive }) => `nav-link${isActive ? ' is-active' : ''}`}>
            Headlines
          </NavLink>
          <NavLink
            to="/requests"
            className={({ isActive }) => `nav-link${isActive ? ' is-active' : ''}`}
          >
            Request Lab
          </NavLink>
        </nav>
      </header>

      <Routes>
        <Route
          path="/"
          element={
            <>
              <Hero
                eyebrow="Live briefing"
                title="Clean, responsive access to today&apos;s news"
                ctaLabel={loading ? 'Refreshing...' : 'Refresh feed'}
                onCta={refresh}
                disabled={loading}
              />
              <FiltersBar
                filters={filters}
                categories={categoryOptions}
                countries={countryOptions}
                onFilterChange={handleFilterChange}
                onRefresh={refresh}
                refreshing={loading}
              />
              <NewsGrid articles={articles} loading={loading} error={error} />
              <section className="link-panel">
                <div>
                  <p className="panel-label">Want to practice POST / PUT / DELETE?</p>
                  <p className="panel-title">Open the Request Lab playground</p>
                </div>
                <NavLink to="/requests" className="pill-link">
                  Try it
                </NavLink>
              </section>
            </>
          }
        />
        <Route
          path="/requests"
          element={
            <>
              <Hero
                eyebrow="Request Lab"
                title="Send POST, PUT, and DELETE calls without leaving the browser"
                subtitle="Backed by jsonplaceholder.typicode.com so every request is real but safe. Track live responses and latency for each verb."
                ctaLabel="News API docs"
                ctaHref="https://newsapi.org/docs"
              />
              <RequestPlayground />
            </>
          }
        />
      </Routes>
    </div>
  )
}

export default App
