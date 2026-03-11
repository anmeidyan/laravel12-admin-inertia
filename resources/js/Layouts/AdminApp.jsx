import { useEffect } from 'react'
import { Link, usePage, Form } from '@inertiajs/react'
import Sidebar from '@/Components/Sidebar';

export default function AdminApp({ children }) {
    useEffect(() => {
        if (window.$) {
            $('[data-widget="treeview"]').Treeview('init')
        }

        document.body.className = "hold-transition sidebar-mini layout-fixed"
        return () => {
            document.body.className = ""
        }
    }, [])

    const { sideMenus } = usePage().props;
    const { url } = usePage();

    return (
        <div className="wrapper">
            <nav className="main-header navbar navbar-expand navbar-white navbar-light">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <a className="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button">
                            <i className="fas fa-bars" style={{ marginTop:'4px' }}></i>
                        </a>
                    </li>
                </ul>

                <ul className="navbar-nav ml-auto">
                    <li className="nav-item dropdown">
                        <a className="nav-link" data-toggle="dropdown" href="#">
                            <i className="far fa-bell" style={{ marginTop:'4px' }}></i>
                            <span className="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span className="dropdown-item dropdown-header">15 Notifications</span>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item">
                                <i className="fas fa-envelope mr-2"></i> 4 new messages
                                <span className="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item">
                                <i className="fas fa-users mr-2"></i> 8 friend requests
                                <span className="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item">
                                <i className="fas fa-file mr-2"></i> 3 new reports
                                <span className="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li className="nav-item">
                        <Form action="/admin-panel/logout" method="post" style={{ marginBottom: 0}}>
                            <button 
                                type="submit" 
                                className="nav-link" 
                                style={{ border:'none', background:'none', cursor: 'pointer'}}
                            >
                                <i className="fas fa-sign-out-alt"></i> Log Out
                            </button>
                        </Form>
                    </li>
                </ul>
            </nav>

            <aside className="main-sidebar sidebar-dark-primary elevation-4">
                <Link href="/admin-panel/dashboard" className="brand-link">
                    <img src={`/storage/dist/img/AdminLTELogo.png`} alt="AdminLTE Logo"
                        className="brand-image img-circle elevation-3" style={{ opacity: '.8' }} />
                    <span className="brand-text font-weight-light">AdminLTE 3</span>
                </Link>

                <div className="sidebar">
                    <nav className="mt-2">
                        <ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li className="nav-item">
                                <Link 
                                    href="/admin-panel/dashboard" 
                                    className={`nav-link ${url.startsWith('/admin-panel/dashboard') ? 'active' : ''}`}
                                >
                                    <i className="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </Link>
                            </li>
                            {Sidebar({ sideMenus})}
                        </ul>
                    </nav>
                </div>
            </aside>

            <div className="content-wrapper">
                {children}
            </div>

            <footer className="main-footer" style={{ fontSize: '14px' }}>
                <strong>Copyright &copy; {new Date().getFullYear()}. All rights reserved.
                    <div className="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.0.0
                    </div>
                </strong>
            </footer>
        </div>
    )
}