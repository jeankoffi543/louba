<template>
	<div class="liens-utiles">
		<SmallBanner :title=title />

		<div class="container ">

			<div class="head-appointment app-title-section underline-title mt-5">
				<h3 class="app-text-uppercase fs-2 ">La listes de nos liens utiles </h3>
			</div>
			<div class="mt-5">
				<table class="table">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col" class="bg-light">Liens</th>

						</tr>
					</thead>
					<tbody>
						<tr v-for=" item in listing" :key="item.id">
							<th class="bg-light fst-italic">{{item.name}}</th>
							<td>{{item.lien}}</td>

						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script src="./_liens-utiles.js"></script>
<style src="./_liens-utiles.less" lang="less" scoped></style>
