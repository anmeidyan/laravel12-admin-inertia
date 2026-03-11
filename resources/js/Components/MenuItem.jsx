import { Link,usePage } from '@inertiajs/react';

export default function MenuItem({ menu }) {
    const { url } = usePage();

    const hasChildren = Array.isArray(menu.children) && menu.children.length > 0;
    const hasActiveChild = hasChildren && menu.children.some(child => url.startsWith(child.url));
    const isMenuOpen = url.startsWith(menu.url) || hasActiveChild;

    return (
        <>
            {hasChildren ? (
                <>
                    <li className={`nav-item ${isMenuOpen ? 'menu-open' : ''}`}>
                        <Link 
                            href="javascript:void(0)" 
                            className={`nav-link ${isMenuOpen ? 'active' : ''}`}
                            onClick={(e) => {
                                e.preventDefault()
                            }}
                        >
                            <i className={`nav-icon fas ${menu.icon}`}></i>
                            <p>
                                {menu.name}
                                <i className="right fas fa-angle-left"></i>
                            </p>
                        </Link>
                        <ul className="nav nav-treeview">
                            {menu.children.map((child) => (
                                <li className="nav-item" key={child.id}>
                                    <Link href={child.url} className={`nav-link ${url.startsWith(child.url) ? 'active' : ''}`}>
                                        <i className="far fa-circle nav-icon"></i>
                                        <p>{child.name}</p>
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </li>
                </>
            ) : (
                <li className="nav-item" key={menu.id}>
                    <Link href={menu.url} className={`nav-link ${url.startsWith(menu.url) ? 'active' : ''}`}>
                        <i className={`nav-icon fas ${menu.icon}`}></i>
                        <p>{menu.name}</p>
                    </Link>
                </li>
            )}
        </>
    );
}