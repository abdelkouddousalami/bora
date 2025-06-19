<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Fish - Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            min-height: 100vh;
            color: #fff;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo h1 {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 50%, #ffd700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #ffd700;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .stat-label {
            color: rgba(255, 215, 0, 0.8);
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-container {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 15px;
            padding: 25px;
        }

        .chart-title {
            color: #ffd700;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Tables Section */
        .section {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            color: #ffd700;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.5);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 215, 0, 0.1);
        }

        th {
            background: rgba(255, 215, 0, 0.1);
            color: #ffd700;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:hover {
            background: rgba(255, 215, 0, 0.05);
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status.active { background: #00ff0020; color: #00ff00; }
        .status.pending { background: #ffaa0020; color: #ffaa00; }
        .status.confirmed { background: #00ff0020; color: #00ff00; }
        .status.cancelled { background: #ff444420; color: #ff4444; }
        .status.read { background: #00ff0020; color: #00ff00; }
        .status.unread { background: #ff444420; color: #ff4444; }

        .btn {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #000;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
        }        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.95);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 15px;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            position: relative;
            transform: translateY(-50px) scale(0.9);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 2rem;
            color: #ffd700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close:hover {
            color: #ffed4e;
            transform: scale(1.2);
        }

        .modal-title {
            color: #ffd700;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reservation-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: rgba(255, 215, 0, 0.05);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .detail-label {
            color: #ffd700;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }        .detail-value {
            color: #fff;
            font-size: 1.1rem;
        }

        .status-select {
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            color: #ffd700;
            padding: 8px;
            border-radius: 4px;
            width: 100%;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .status-select:hover, .status-select:focus {
            background: rgba(255, 215, 0, 0.2);
            border-color: #ffd700;
        }

        .status-select option {
            background: #1a1a1a;
            color: #ffd700;
        }

        .delete-btn {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }

        .delete-btn:hover {
            background: rgba(255, 68, 68, 0.2);
            border-color: #ff4444;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .reservation-details {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
            
            .user-info {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo">
                <h1>Bora Fish</h1>
            </div>            <div class="user-info">
                <span>Welcome, {{ Auth::user()->name }}</span>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" id="totalUsers">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalMessages">{{ $totalMessages }}</div>
                <div class="stat-label">Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalReservations">{{ $totalReservations }}</div>
                <div class="stat-label">Reservations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="monthlyRevenue">${{ number_format($monthlyRevenue, 2) }}</div>
                <div class="stat-label">Monthly Revenue</div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts-grid">
            <div class="chart-container">
                <h3 class="chart-title">User Growth</h3>
                <canvas id="userChart"></canvas>
            </div>
            <div class="chart-container">
                <h3 class="chart-title">Reservation Status</h3>
                <canvas id="reservationChart"></canvas>
            </div>
        </div>        <!-- Recent Users Section -->
        <div class="section">
            <h2 class="section-title">Recent Users</h2>
            <div class="table-container">
                <table id="recentUsersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="status {{ $user->reservations_count > 0 ? 'active' : 'pending' }}">
                                        {{ $user->reservations_count > 0 ? 'active' : 'pending' }}
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No recent users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- All Users Section -->
        <div class="section">
            <h2 class="section-title">All Users</h2>
            <div class="table-container">
                <table id="allUsersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                            <th>Total Reservations</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>{{ $user->reservations_count }}</td>
                                <td>
                                    <span class="status {{ $user->reservations_count > 0 ? 'active' : 'pending' }}">
                                        {{ $user->reservations_count > 0 ? 'active' : 'pending' }}
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="section">
            <h2 class="section-title">Recent Messages</h2>
            <div class="table-container">
                <table id="messagesTable">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Message functionality coming soon</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        <!-- Recent Reservations Section -->
        <div class="section">
            <h2 class="section-title">Recent Reservations</h2>
            <div class="table-container">
                <table id="recentReservationsTable">
                    <thead>                        <tr>                            <th>Customer</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Phone</th>
                            <th>Tour Type</th>
                            <th>Guests</th>
                            <th>Total Bookings</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestReservations as $reservation)
                            <tr>                                <td>{{ $reservation->user ? $reservation->user->name : $reservation->name }}</td>
                                <td>{{ $reservation->date->format('M d, Y') }}</td>
                                <td>{{ $reservation->time ? $reservation->date->format('h:i A') : 'N/A' }}</td>
                                <td>{{ $reservation->phone ?? 'N/A' }}</td>
                                <td>{{ $reservation->tour_type }}</td>
                                <td>{{ $reservation->guests }}</td>
                                <td>
                                    @if($reservation->user)
                                        <span class="badge">{{ $reservation->user->reservations_count }}</span>
                                    @else
                                        <span class="badge">1</span>
                                    @endif
                                </td>
                                <td><span class="status {{ $reservation->status }}">{{ $reservation->status }}</span></td>
                                <td>
                                    <button class="btn" onclick="showReservationDetails({{ $reservation->id }})">View Details</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No recent reservations found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- All Reservations Section -->
        <div class="section">
            <h2 class="section-title">All Reservations</h2>
            <div class="table-container">
                <table id="allReservationsTable">
                    <thead>                        <tr>                            <th>Customer</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Phone</th>
                            <th>Tour Type</th>
                            <th>Guests</th>
                            <th>Total Bookings</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allReservations as $reservation)
                            <tr>                                <td>{{ $reservation->user ? $reservation->user->name : $reservation->name }}</td>
                                <td>{{ $reservation->date->format('M d, Y') }}</td>
                                <td>{{ $reservation->time ? $reservation->date->format('h:i A') : 'N/A' }}</td>
                                <td>{{ $reservation->phone ?? 'N/A' }}</td>
                                <td>{{ $reservation->tour_type }}</td>
                                <td>{{ $reservation->guests }}</td>
                                <td>${{ number_format($reservation->price ?? 0, 2) }}</td>
                                <td><span class="status {{ $reservation->status }}">{{ $reservation->status }}</span></td>
                                <td>
                                    <button class="btn" onclick="showReservationDetails({{ $reservation->id }})">View Details</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No reservations found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reservation Details Modal -->
    <div id="reservationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 class="modal-title">Reservation Details</h2>
            <div class="reservation-details" id="reservationDetails">
                <!-- Details will be populated here -->
            </div>
        </div>
    </div>    <script>        // Data from Laravel
        const latestUsers = @json($latestUsers);
        const allUsers = @json($allUsers);
        const latestReservations = @json($latestReservations);
        const allReservations = @json($allReservations);
        const userGrowthData = @json($userGrowth);
        const reservationStats = @json($reservationStats);

        // Populate tables        function populateRecentUsersTable() {
            try {
                const tbody = document.getElementById('recentUsersTableBody');
                if (!tbody) {
                    console.error('Recent users table body not found');
                    return;
                }
                tbody.innerHTML = '';
                
                if (!Array.isArray(latestUsers) || latestUsers.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center">No recent users found</td></tr>';
                    return;
                }
                
                latestUsers.forEach(user => {
                    const joinDate = new Date(user.created_at).toLocaleDateString();
                    const status = user.reservations_count > 0 ? 'active' : 'pending';
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${user.name || 'N/A'}</td>
                        <td>${user.email || 'N/A'}</td>
                        <td>${joinDate}</td>
                        <td><span class="status ${status}">${status}</span></td>
                    `;
                });
            } catch (error) {
                console.error('Error populating recent users table:', error);
            }
        }

        function populateAllUsersTable() {
            try {
                const tbody = document.getElementById('allUsersTableBody');
                if (!tbody) {
                    console.error('All users table body not found');
                    return;
                }
                tbody.innerHTML = '';
                
                if (!Array.isArray(allUsers) || allUsers.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center">No users found</td></tr>';
                    return;
                }
                
                allUsers.forEach(user => {
                    const joinDate = new Date(user.created_at).toLocaleDateString();
                    const status = user.reservations_count > 0 ? 'active' : 'pending';
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${user.name || 'N/A'}</td>
                        <td>${user.email || 'N/A'}</td>
                        <td>${joinDate}</td>
                        <td>${user.reservations_count || 0}</td>
                        <td><span class="status ${status}">${status}</span></td>
                    `;
                });
            } catch (error) {
                console.error('Error populating all users table:', error);
            }
        }

        function populateMessagesTable() {
            const tbody = document.getElementById('messagesTableBody');
            if (!tbody) {
                console.error('Messages table body not found');
                return;
            }
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">Message functionality coming soon</td></tr>';
        }        function populateReservationsTables() {
            try {
                // Populate Recent Reservations
                const recentTbody = document.getElementById('recentReservationsTableBody');
                if (!recentTbody) {
                    console.error('Recent reservations table body not found');
                    return;
                }
                recentTbody.innerHTML = '';
                
                if (!Array.isArray(latestReservations) || latestReservations.length === 0) {
                    recentTbody.innerHTML = '<tr><td colspan="7" class="text-center">No recent reservations found</td></tr>';
                    return;
                }
                
                latestReservations.forEach(reservation => {
                    const date = new Date(reservation.date).toLocaleDateString();
                    const time = reservation.time ? new Date(reservation.date + ' ' + reservation.time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'N/A';
                    const row = recentTbody.insertRow();
                    row.innerHTML = `
                        <td>${reservation.user ? reservation.user.name : (reservation.name || 'N/A')}</td>
                        <td>${date}</td>
                        <td>${time}</td>
                        <td>${reservation.tour_type || 'N/A'}</td>
                        <td>${reservation.guests || 'N/A'}</td>
                        <td><span class="status ${reservation.status || 'pending'}">${reservation.status || 'pending'}</span></td>
                        <td><button class="btn" onclick="showReservationDetails(${reservation.id})">View Details</button></td>
                    `;
                });

                // Populate All Reservations
                const allTbody = document.getElementById('allReservationsTableBody');
                if (!allTbody) {
                    console.error('All reservations table body not found');
                    return;
                }
                allTbody.innerHTML = '';
                
                if (!Array.isArray(allReservations) || allReservations.length === 0) {
                    allTbody.innerHTML = '<tr><td colspan="8" class="text-center">No reservations found</td></tr>';
                    return;
                }
                
                allReservations.forEach(reservation => {
                    const date = new Date(reservation.date).toLocaleDateString();
                    const time = reservation.time ? new Date(reservation.date + ' ' + reservation.time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'N/A';
                    const row = allTbody.insertRow();
                    row.innerHTML = `
                        <td>${reservation.user ? reservation.user.name : (reservation.name || 'N/A')}</td>
                        <td>${date}</td>
                        <td>${time}</td>
                        <td>${reservation.tour_type || 'N/A'}</td>
                        <td>${reservation.guests || 'N/A'}</td>
                        <td>$${reservation.price ? parseFloat(reservation.price).toFixed(2) : '0.00'}</td>
                        <td><span class="status ${reservation.status || 'pending'}">${reservation.status || 'pending'}</span></td>
                        <td><button class="btn" onclick="showReservationDetails(${reservation.id})">View Details</button></td>
                    `;
                });
            } catch (error) {
                console.error('Error populating reservations tables:', error);
            }
        }        // Show reservation details        function showReservationDetails(reservationId) {
            // Find the reservation
            const reservation = allReservations.find(r => r.id === reservationId) || 
                              latestReservations.find(r => r.id === reservationId);
            
            if (!reservation) {
                console.error('Reservation not found:', reservationId);
                return;
            }

            // Format date and time
            const dateObj = new Date(reservation.date);
            const date = dateObj.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            const time = reservation.time ? dateObj.toLocaleTimeString([], { 
                hour: '2-digit', 
                minute: '2-digit' 
            }) : 'N/A';

            // Create the modal content
            const detailsContainer = document.getElementById('reservationDetails');
            detailsContainer.innerHTML = `
                <div class="detail-item">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">${reservation.user ? reservation.user.name : (reservation.name || 'N/A')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">${reservation.user ? reservation.user.email : (reservation.email || 'N/A')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value">${reservation.phone || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Date</div>
                    <div class="detail-value">${date}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Time</div>
                    <div class="detail-value">${time}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Number of Guests</div>
                    <div class="detail-value">${reservation.guests || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tour Type</div>
                    <div class="detail-value">${reservation.tour_type || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Price</div>
                    <div class="detail-value">$${(reservation.price || 0).toFixed(2)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>                    <div class="detail-value">
                        <form :action="'{{ route('admin.reservations.update-status', '_ID_') }}'.replace('_ID_', reservation.id)" 
                              method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="status-select" onchange="this.form.submit()">
                                <option value="pending" ${reservation.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="confirmed" ${reservation.status === 'confirmed' ? 'selected' : ''}>Confirmed</option>
                                <option value="cancelled" ${reservation.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Actions</div>
                    <div class="detail-value">
                        <form :action="'{{ route('admin.reservations.delete', '_ID_') }}'.replace('_ID_', reservation.id)"
                              method="POST" 
                              style="display: inline;" 
                              onsubmit="return confirm('Are you sure you want to delete this reservation? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-trash"></i> Delete Reservation
                            </button>
                        </form>
                    </div>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Message</div>
                    <div class="detail-value">${reservation.message || 'No message'}</div>
                </div>
            `;

            // Show the modal with animation
            const modal = document.getElementById('reservationModal');
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('show'), 10);
        }

        // Close modal        function closeModal() {
            const modal = document.getElementById('reservationModal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Charts        function createUserChart() {
            try {
                const ctx = document.getElementById('userChart').getContext('2d');
                if (!ctx) {
                    console.error('User chart canvas not found');
                    return;
                }

                const months = Object.keys(userGrowthData);
                const counts = Object.values(userGrowthData);
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'New Users',
                            data: counts,
                            borderColor: '#ffd700',
                            backgroundColor: 'rgba(255, 215, 0, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#ffd700'
                                }
                            }
                        },
                        scales: {
                            y: {
                                ticks: {
                                    color: '#ffd700'
                                },
                                grid: {
                                    color: 'rgba(255, 215, 0, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#ffd700'
                                },
                                grid: {
                                    color: 'rgba(255, 215, 0, 0.1)'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error creating user chart:', error);
            }
        }        function createReservationChart() {
            try {
                const ctx = document.getElementById('reservationChart').getContext('2d');
                if (!ctx) {
                    console.error('Reservation chart canvas not found');
                    return;
                }

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Confirmed', 'Pending', 'Cancelled'],
                        datasets: [{
                            data: Object.values(reservationStats),
                            backgroundColor: [
                                '#00ff00',
                                '#ffaa00',
                                '#ff4444'
                            ],
                            borderColor: '#000',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#ffd700'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error creating reservation chart:', error);
            }
        }

        // Logout function
        function logout() {
            document.getElementById('logoutForm').submit();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('reservationModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Latest Users:', latestUsers);
            console.log('All Users:', allUsers);
            console.log('Latest Reservations:', latestReservations);
            console.log('All Reservations:', allReservations);
            console.log('User Growth Data:', userGrowthData);
            console.log('Reservation Stats:', reservationStats);

            populateRecentUsersTable();
            populateAllUsersTable();
            populateMessagesTable();
            populateReservationsTables();
            createUserChart();
            createReservationChart();
        });    </script></body>
</html>