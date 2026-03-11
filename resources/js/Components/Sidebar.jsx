import MenuItem from './MenuItem';

export default function Sidebar({ sideMenus }) {

    return (
        <>
            {sideMenus.map(menu => (
                <MenuItem key={menu.id} menu={menu} />
            ))}
        </>
    );
}