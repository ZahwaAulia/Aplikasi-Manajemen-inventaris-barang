# TODO List - User Registration and Role Management

## Completed Tasks
- [x] Add status column to users table for staff confirmation
- [x] Run migration to add status column to users table
- [x] Run migration to add 'rejected' to status enum
- [x] Update User model with status fillable and helper methods
- [x] Modify registration to only allow guest and staff roles
- [x] Set status to 'pending' for staff, 'confirmed' for guest during registration
- [x] Update login to check staff status before allowing login
- [x] Create UserController for admin user management
- [x] Add routes for user management under admin middleware
- [x] Create views for user index and create admin
- [x] Update admin dashboard with user management link
- [x] Remove admin option from registration form
- [x] Update registration validation to exclude admin role
- [x] Fix corrupted routes/web.php file
- [x] Implement UserController methods (index, create, store, confirm, reject)

## Remaining Tasks
- [x] Fixed registration route error (register.process -> register)
- [x] Updated existing users' status to confirmed
- [x] Removed admin option from registration form
- [x] Updated AuthController to handle staff pending status
- [x] Added isConfirmed method to User model
- [ ] Test the registration functionality for guests (requires manual testing - server running on http://127.0.0.1:8000)
- [ ] Test staff registration and pending status (requires manual testing)
- [ ] Test admin confirmation of staff accounts (requires manual testing)
- [ ] Test admin creation by existing admin (requires manual testing)
- [ ] Test login restrictions for pending staff (requires manual testing)

## Notes
- Guests can register freely and are immediately confirmed
- Staff register but need admin approval to login
- Only existing admins can create new admins
- Admins can confirm pending staff accounts
