# TODO List for Inventory Management Web Application

## Phase 1: Authentication and Middleware
- [ ] Implement RoleMiddleware logic for role-based access control
- [ ] Update routes/web.php with middleware groups for Admin, Staff, Guest
- [ ] Ensure authentication routes are properly configured

## Phase 2: Controllers
- [ ] Create CategoryController with CRUD operations
- [ ] Create SupplierController with CRUD operations
- [ ] Update DashboardController to show role-specific data
- [ ] Update ItemController with search, filter, and pagination enhancements

## Phase 3: Views and UI
- [ ] Create login view with role selection
- [ ] Create admin dashboard view
- [ ] Create staff dashboard view
- [ ] Create guest dashboard view (public data)
- [ ] Create CRUD views for items, categories, suppliers with role restrictions
- [ ] Implement partial views for forms and lists
- [ ] Add pagination, search, and filter to views

## Phase 4: Validation and Upload
- [ ] Add form validation to all controllers
- [ ] Implement file upload for item images
- [ ] Ensure validation rules are comprehensive

## Phase 5: Testing and Finalization
- [ ] Run migrations and seeders
- [ ] Test role-based access
- [ ] Test CRUD operations
- [ ] Verify search, filter, pagination
- [ ] Test file uploads
