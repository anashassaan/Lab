function FiltersBar({ filters, categories, countries, onFilterChange, onRefresh, refreshing }) {
  return (
    <section className="filters-bar">
      <div className="filter-field">
        <label htmlFor="country-select">Country</label>
        <select
          id="country-select"
          value={filters.country}
          onChange={(event) => onFilterChange('country', event.target.value)}
        >
          {countries.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
      </div>

      <div className="filter-field">
        <label htmlFor="category-select">Category</label>
        <select
          id="category-select"
          value={filters.category}
          onChange={(event) => onFilterChange('category', event.target.value)}
        >
          {categories.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
      </div>

      <div className="filter-actions">
        <button type="button" className="refresh-chip" onClick={onRefresh} disabled={refreshing}>
          {refreshing ? 'Loading...' : 'Fetch now'}
        </button>
      </div>
    </section>
  )
}

export default FiltersBar
