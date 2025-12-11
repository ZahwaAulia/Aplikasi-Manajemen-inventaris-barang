# TODO List for Inventory Management App

## 1. Database & Models
- [ ] Create migration to add 'role' column to users table
- [ ] Update User model with role attribute
- [ ] Run migrations

## 2. Authentication & Middleware
- [ ] Install Laravel Breeze
- [ ] Create RoleMiddleware
- [ ] Register middleware
- [ ] Update routes with authentication and role protection

## 3. Controllers & CRUD
- [ ] Create CategoryController with full CRUD
- [ ] Create SupplierController with full CRUD
- [ ] Update ItemController with search/filter
- [ ] Update DashboardController with real stats

## 4. Views
- [ ] Create auth views (login/register) via Breeze
- [ ] Create admin views for categories (index, create, edit)
- [ ] Create admin views for suppliers (index, create, edit)
- [ ] Update admin items views (edit, show)
- [ ] Create guest views (public item list)
- [ ] Create partial views (item card, etc.)
- [ ] Update sidebar navigation
- [ ] Update dashboard with real data

## 5. Seeders & Testing
- [ ] Create RoleSeeder
- [ ] Create sample data seeders
- [ ] Run seeders
- [ ] Build assets
- [ ] Test all functionality

## 6. Final Touches
- [ ] Ensure file uploads work
- [ ] Add pagination to all lists
- [ ] Implement search/filter UI
- [ ] Role-based access verification
